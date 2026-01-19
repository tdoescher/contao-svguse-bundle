<?php

/**
 * This file is part of SvgUseBundle for Contao
 *
 * @package     tdoescher/svguse-bundle
 * @author      Torben Döscher <mail@tdoescher.de>
 * @license     LGPL
 * @copyright   tdoescher.de // WEB & IT <https://tdoescher.de>
 */

namespace tdoescher\SvgUseBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use tdoescher\SvgUseBundle\SvgUseBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(SvgUseBundle::class)
                ->setLoadAfter([ ContaoCoreBundle::class ]),
        ];
    }
}
