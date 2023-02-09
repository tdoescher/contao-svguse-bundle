<?php

/**
 * This file is part of SvgUseBundle for Contao
 *
 * @package     tdoescher/svguse-bundle
 * @author      Torben Döscher <mail@tdoescher.de>
 * @license     LGPL
 * @copyright   tdoescher.de // WEB & IT <https://tdoescher.de>
 */

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
