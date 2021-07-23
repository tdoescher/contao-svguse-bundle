<?php

namespace tdoescher\SvgUseBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("replaceInsertTags")
 */
class ReplaceInsertTagsListener
{
    public function __invoke(string $insertTag): ?string
    {
        $split = explode('::', $insertTag);

        if(!in_array($split[0], ['svguse', 'svgimport']) && !isset($split[1]))
        {
            return false;
        }

        if ($split[0] === 'svguse')
        {
            return '<svg class="icon icon-'.$split[1].'"><use xlink:href="'.\Environment::get('request').'#icon-'.$split[1].'"></use></svg>';
        }

        if ($split[0] === 'svgimport' && file_exists(\Environment::get('documentRoot').'/../files/'.$split[1].'.svg'))
        {
            return file_get_contents(\Environment::get('documentRoot').'/../files/'.$split[1].'.svg');
        }

        return false;
    }
}
