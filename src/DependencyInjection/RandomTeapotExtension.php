<?php

namespace Fabricio872\RandomTeapotBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RandomTeapotExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $eventDefinition = $container->getDefinition('fabricio872_random_teapot.event_listener.request_listener');
        $eventDefinition->setArgument(0, $config['randomness']);
        $eventDefinition->setArgument(1, $config['path_filter']);
        $eventDefinition->setArgument(2, $config['template']);
    }
}