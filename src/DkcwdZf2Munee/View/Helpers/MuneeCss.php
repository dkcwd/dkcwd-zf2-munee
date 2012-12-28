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
     * @param array $array An array containing strings representing paths to css files.
     * @param bool $minify [optional] a switch to disable css file minification
     * @return A formatted string or null if invalid parameters are supplied
     */
    public function __invoke($array, $minify = true)
    {   
        if (! is_array($array)) return;
        $minifyValue = ($minify == false) ? 'false' : 'true';
        
        $string = '';
        $tempArray = array();
        
        foreach ($array as $item) {
            if (! is_string($item)) continue;
            $tempArray[] = $item;
        }      
        
        if (count($tempArray) == 0) return; 
                
        $string = implode(',', $tempArray);
        unset($tempArray);
        
        return '<link rel="stylesheet" href="/munee?files=' . $string . '&minify=' . $minifyValue .'">' . PHP_EOL;
    }
}