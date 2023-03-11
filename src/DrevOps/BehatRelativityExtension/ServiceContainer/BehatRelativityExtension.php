<?php
/**
 * @file
 * Behat relativity extension.
 */

namespace DrevOps\BehatRelativityExtension\ServiceContainer;

use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class RelativityExtension.
 */
class BehatRelativityExtension implements ExtensionInterface
{

    /**
     * Extension configuration ID.
     */
    const MOD_ID = 'drevops_relativity';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return self::MOD_ID;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        // @codingStandardsIgnoreStart
        $builder->children()
            ->arrayNode('components')
                ->normalizeKeys(false)
                ->useAttributeAsKey('key')
                ->prototype('variable')
                ->end()
            ->end()
            ->integerNode('offset')
                ->defaultValue(0)
            ->end()
            ->arrayNode('breakpoints')
                ->useAttributeAsKey('key')
                    ->info('Name of device or screen size.')
                    ->isRequired()
                    ->prototype('array')
                        ->children()
                        ->integerNode('width')
                            ->info('Screen width.')
                            ->isRequired()
                        ->end()
                        ->integerNode('height')
                            ->isRequired()
                            ->info('Screen height.')
                        ->end()
                        ->booleanNode('default')
                            ->info('Set screen size as default.')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->scalarNode('jquery_version')
                ->defaultValue('1.12.4')
            ->end();
        // @codingStandardsIgnoreEnd
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $definition = new Definition('DrevOps\BehatRelativityExtension\Context\Initializer\RelativityContextInitializer', [
            $config['components'],
            $config['offset'],
            $config['breakpoints'],
            $config['jquery_version'],
        ]);
        $definition->addTag(ContextExtension::INITIALIZER_TAG, ['priority' => 0]);
        $container->setDefinition('drevops_relativity.relativity_context_initializer', $definition);
    }
}
