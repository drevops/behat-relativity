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
                    prototype('variable')->
                    end()->
                end()
                ->scalarNode('offset')->
                    isRequired()->
                end()
                ->arrayNode('breakpoints')->
                    useAttributeAsKey('key')->
                    prototype('variable')->
                    end()->
                end()
                ->scalarNode('jqueryVersion')->
                    cannotBeEmpty()->
                    end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        if ($this->validateConfig($config)) {
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

    /**
     * Function for validation got data in current config.
     *
     * @param array $config Current config.
     *
     * @return bool
     */
    protected function validateConfig(array $config)
    {
        $result = false;

        if (!isset($config['components'])) {
            throw new RuntimeException('Parameter components is not determine in behat config.');
        } elseif (!is_array($config['components'])) {
            throw new RuntimeException('Parameter components is not array.');
        } elseif (!isset($config['offset'])) {
            throw new RuntimeException('Parameter offset is not determine in behat config.');
        } elseif (!is_int($config['offset'])) {
            throw new RuntimeException('Parameter offset is not integer.');
        } elseif (!isset($config['breakpoints'])) {
            throw new RuntimeException('Parameter breakpoints is not determine in behat config.');
        } elseif (!is_array($config['breakpoints'])) {
            throw new RuntimeException('Parameter breakpoints is not array.');
        } elseif (!isset($config['jqueryVersion'])) {
            throw new RuntimeException('Parameter jqueryVersion is not determine in behat config.');
        } elseif (!is_string($config['jqueryVersion'])) {
            throw new RuntimeException('Parameter jqueryVersion is not string (Example: "1.12.4").');
        } else {
            $result = true;
        }

        return $result;
    }
}
