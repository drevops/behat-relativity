<?php
/**
 * @file
 * Behat relativity extension.
 */

namespace IntegratedExperts\Behat\Relativity;

use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use WebDriver\Exception;

/**
 * Class RelativityExtension.
 */
class RelativityExtension implements ExtensionInterface
{

    /**
     * Extension configuration ID.
     */
    const MOD_ID = 'integratedexperts_relativity';

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
        $builder->
            children()
                ->arrayNode('components')->
                    useAttributeAsKey('key')->
                        info('Name of component: shouldn\'t content dash "-" or remember it transformed to underscore "_" ')->
                        isRequired()->
                    prototype('variable')->
                      isRequired()->
                    end()->
                end()
                ->scalarNode('offset')->
                    defaultValue(0)->
                end()
                ->arrayNode('breakpoints')->
                    useAttributeAsKey('key')->
                        info('Name of devise or screen size.')->
                        isRequired()->
                    arrayPrototype()->
                        children()->
                            scalarNode('width')->
                                info('Screen width.')->
                                isRequired()->
                                    end()->
                            scalarNode('height')->
                                isRequired()->
                                    info('Screen height.')->
                                    end()->
                            booleanNode('default')->
                                info('Set screen size as default.')->
                                defaultFalse()->
                                    end()->
                        end()->
                    end()->
                end()
                ->scalarNode('jqueryVersion')->
                    defaultValue('2.2.4')->
                    end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        if (count(array_keys(array_column($config['breakpoints'], 'default'), true)) < 1) {
            throw new RuntimeException('One of breakpoints parameters must be default, please add to one of breakpoints (default: true) behat.yml.');
        } elseif (count(array_keys(array_column($config['breakpoints'], 'default'), true)) > 1) {
            throw new RuntimeException('Only one of breakpoints parameters should be default, please remove other (default: true) records in your behat.yml.');
        } else {
            $definition = new Definition('IntegratedExperts\Behat\Relativity\Context\Initializer\RelativityContextInitializer', [
                $config['components'],
                $config['offset'],
                $config['breakpoints'],
                $config['jqueryVersion'],
            ]);
            $definition->addTag(ContextExtension::INITIALIZER_TAG, ['priority' => 0]);
            $container->setDefinition('integratedexperts_relativity.relativity_context_initializer', $definition);
        }
    }
}
