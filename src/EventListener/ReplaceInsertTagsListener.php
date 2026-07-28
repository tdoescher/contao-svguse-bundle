<?php

/**
 * This file is part of SvgUseBundle for Contao
 *
 * @package     tdoescher/svguse-bundle
 * @author      Torben Döscher <mail@tdoescher.de>
 * @license     LGPL
 * @copyright   tdoescher.de // WEB & IT <https://tdoescher.de>
 */

namespace tdoescher\SvgUseBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsInsertTag;
use Contao\CoreBundle\InsertTag\InsertTagResult;
use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ReplaceInsertTagsListener
{
    public function __construct(#[Autowire('%kernel.project_dir%')] private readonly string $projectDir)
    {
    }

    #[AsInsertTag('svgicon')]
    public function renderSvgIcon(ResolvedInsertTag $insertTag): InsertTagResult
    {
        $icon = $insertTag->getParameters()->get(0);

        if (!$icon) return new InsertTagResult('', OutputType::text);

        $class = $insertTag->getParameters()->get(1);
        $classes = $class ? 'icon-' . $icon . ' ' . str_replace(',', ' ', trim(htmlspecialchars($class, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'))) : 'icon-' . $icon;

        return new InsertTagResult('<span aria-hidden="true" class="' . $classes . '"></span>', OutputType::html);
    }

    #[AsInsertTag('svguse')]
    public function renderSvgUse(ResolvedInsertTag $insertTag): InsertTagResult
    {
        $icon = $insertTag->getParameters()->get(0);

        if (!$icon) return new InsertTagResult('', OutputType::text);

        $class = $insertTag->getParameters()->get(1);
        $classes = $class ? 'icon-' . $icon . ' ' . str_replace(',', ' ', trim(htmlspecialchars($class, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'))) : 'icon-' . $icon;

        return new InsertTagResult('<svg aria-hidden="true" class="' . $classes . '"><use href="#icon-' . $icon . '"></use></svg>', OutputType::html);
    }

    #[AsInsertTag('svgimport')]
    public function renderSvgImport(ResolvedInsertTag $insertTag): InsertTagResult
    {
        $icon = $insertTag->getParameters()->get(0);
        $path = $this->projectDir . '/files/' . $icon . '.svg';

        if (!file_exists($path)) return new InsertTagResult('', OutputType::text);

        $html = (string) file_get_contents($path);

        return new InsertTagResult($html, OutputType::html);
    }
}
