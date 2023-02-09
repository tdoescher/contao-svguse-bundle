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

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Environment;

#[AsHook('replaceInsertTags', priority: 100)]
class ReplaceInsertTagsListener
{
  public function __invoke(string $insertTag)
  {
    $list = explode('::', $insertTag);
    $insertTag = $list[0];
    $icon = isset($list[1]) ? $list[1] : false;
    $class = isset($list[2]) ? $list[2] : false;
    $classes = ($class) ? 'icon-'.$icon.' '.str_replace(',', ' ', trim($class)) : 'icon-'.$icon;

    if(!in_array($insertTag, ['svgicon', 'svguse', 'svgimport']) || $icon === false)
    {
      return false;
    }

    if ($insertTag === 'svgicon')
    {
      return '<span class="'.$classes.'"></span>';
    }

    if ($insertTag === 'svguse')
    {
      return '<svg class="icon '.$classes.'"><use xlink:href="'.Environment::get('request').'#icon-'.$icon.'"></use></svg>';
    }

    if ($insertTag === 'svgimport' && file_exists(Environment::get('documentRoot').'/../files/'.$icon.'.svg'))
    {
      return file_get_contents(Environment::get('documentRoot').'/../files/'.$icon.'.svg');
    }

    return false;
  }
}
