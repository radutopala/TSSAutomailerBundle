<?php

namespace TSS\AutomailerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use TSS\AutomailerBundle\DefaultEntity\Automailer;

/**
 * This is the class that validates and merges configuration from your app/config files.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tss_automailer');

        $rootNode
            ->children()
                ->scalarNode('class')
                    ->defaultValue(Automailer::class)
                ->end()
                ->scalarNode('manager')
                    ->defaultValue('doctrine.orm.entity_manager')
                ->end()
                ->booleanNode('disable_default_document')
                    ->defaultFalse()
                ->end()
                ->booleanNode('disable_default_entity')
                    ->defaultFalse()
                ->end()
                ->booleanNode('beanstalk')
                    ->defaultValue(false)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
