<?php

namespace Fabricio872\RandomTeapotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('RandomTeapotBundle');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode("randomness")->defaultValue(0.01)->info('Define how often should error 418 be given. (0.01 is 1% of all requests)')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}