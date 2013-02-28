<?php 
/**
 * @link http://github.com/dkcwd/dkcwd-zf2-munee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au
 * @copyright (c) Dave Clark 2012 (https://www.dkcwd.com.au)
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2Munee\View\Helpers;

use Zend\View\Helper\AbstractHelper;

class MuneeCss extends AbstractHelper
{
    /**
     * View helper to format strings for making requests to the Munee Controller via the
     * custom route provided in this module.
     *
     * @param array $files An array containing strings representing paths to css files.
     * @param bool $minify [optional] a switch to disable js file minification
     * @param bool $returnElementWrapper [optional] a switch to prevent wrapping the path
     * returned within an element wrapper
     * @return string|null A formatted string or null if invalid parameters are supplied
     */
    public function __invoke($files, $minify = true, $returnElementWrapper = true)
    {
        if (! is_array($files)) {
            return null;
        }
    
        foreach ($files as $k => $item) {
            if (! is_string($item)) {
                unset($files[$k]);
            }
        }
    
        if (empty($files)) {
            return null;
        }
    
        $minifyValue = ($minify === false) ? 'false' : 'true';
        $src = sprintf('/munee?files=%s&minify=%s', implode(',', $files), $minifyValue);
    
        if ((boolean) $returnElementWrapper) {
            return sprintf('<link rel="stylesheet" href="%s">', $src) . PHP_EOL;
        } else {
            return $src . PHP_EOL;
        }
    }
}