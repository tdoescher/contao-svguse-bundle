<?php

namespace tdoescher\SvgUseBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Environment;

/**
 * @Hook("replaceInsertTags")
 */
class ReplaceInsertTagsListener
{
    public function __invoke(string $tag)
    {
        list($tag, $value) = explode('::', $tag);

        if(!in_array($tag, ['svguse', 'svgimport']) && !isset($value))
        {
            return false;
        }

        if ($tag === 'svguse')
        {
            return '<svg class="icon icon-'.$value.'"><use xlink:href="'.Environment::get('request').'#icon-'.$value.'"></use></svg>';
        }

        if ($tag === 'svgimport')
        {
            if(file_exists(Environment::get('documentRoot').'/../files/'.$value.'.svg'))
            {
                return file_get_contents(Environment::get('documentRoot').'/../files/'.$value.'.svg');
            }
            else
            {
                return false;
            }
        }
    }
}
