<?php

namespace tdoescher\SvgUseBundle\DependencyInjection; 

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SvgUseExtension extends Extension
{ 
    public function load(array $mergedConfig, ContainerBuilder $container)
    { 
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('listener.yaml');
    } 
}
