<?php

namespace tdoescher\SvgUseBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Environment;

/**
 * @Hook("replaceInsertTags")
 */
class ReplaceInsertTagsListener
{
    public function __invoke(string $tag)
    {
        $list = explode('::', $tag);
        $tag = $list[0];
        $icon = isset($list[1]) ? $list[1] : false;
        $class = isset($list[2]) ? $list[2] : false;
        $classes = ($class) ? 'icon-'.$icon.' '.str_replace(',', ' ', trim($class)) : 'icon-'.$icon;

        if(!in_array($tag, ['svgicon', 'svguse', 'svgimport']) || $icon === false)
        {
            return false;
        }

        if ($tag === 'svgicon')
        {
            return '<span class="'.$classes.'"></span>';
        }

        if ($tag === 'svguse')
        {
            return '<svg class="icon '.$classes.'"><use xlink:href="'.Environment::get('request').'#icon-'.$icon.'"></use></svg>';
        }

        if ($tag === 'svgimport' && file_exists(Environment::get('documentRoot').'/../files/'.$icon.'.svg'))
        {
            return file_get_contents(Environment::get('documentRoot').'/../files/'.$icon.'.svg');
        }

        return false;
    }
}
