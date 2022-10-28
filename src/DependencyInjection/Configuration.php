<?php

namespace Fabricio872\RandomTeapotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('random_teapot');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode("randomness")->defaultValue(0.01)->info('Define how often should error 418 be given. (0.01 is 1% of all requests)')->end()
                ->scalarNode("path_filter")->defaultValue("*")->info('Set filter for paths you want this to be applied')->end()
                ->scalarNode("template")->defaultValue("@RandomTeapot/i_am_a_teapot.html.twig")->info('Change default template for 418 error')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}