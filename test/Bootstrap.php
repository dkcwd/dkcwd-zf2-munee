<?php
/**
 * @link http://github.com/dkcwd/dkcwd-zf2-munee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au
 * @copyright (c) Dave Clark 2012 (https://www.dkcwd.com.au)
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2MuneeTest;

use Zend\Loader\AutoloaderFactory;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

class Bootstrap
{
    
    public static function init()
    {
        static::initAutoloader();
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
            return;
        }

        $zf2Path = getenv('ZF2_PATH') ?: (defined('ZF2_PATH') ? ZF2_PATH : (is_dir($vendorPath . '/ZF2/library') ? $vendorPath . '/ZF2/library' : false));

        if (!$zf2Path) {
            throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
        }

        if (isset($loader)) {
            $loader->add('Zend', $zf2Path . '/Zend');
        } else {
            include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
            include $zf2Path . '/Zend/Loader/ClassMapAutoloader.php';
            AutoloaderFactory::factory(array(
                'Zend\Loader\ClassMapAutoloader' => array(array(
                    'DkcwdZf2Munee\View\Helpers\MuneeCss' => __DIR__ . '/../src/DkcwdZf2Munee/View/Helpers/MuneeCss.php',
                    'DkcwdZf2Munee\View\Helpers\MuneeImg' => __DIR__ . '/../src/DkcwdZf2Munee/View/Helpers/MuneeImg.php',
                    'DkcwdZf2Munee\View\Helpers\MuneeJs' => __DIR__ . '/../src/DkcwdZf2Munee/View/Helpers/MuneeJs.php',
                )),
                'Zend\Loader\StandardAutoloader' => array(
                    'autoregister_zf' => true,
                    'namespaces' => array(
                        'DkcwdZf2Munee' => __DIR__ . '/../src/DkcwdZf2Munee',
                        __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                    ),
                ),
            ));
        }
    }

    protected static function findParentPath($path)
    {
        $dir         = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);

            if ($previousDir === $dir) {
                return false;
            }

            $previousDir = $dir;
        }

        return $dir . '/' . $path;
    }
}

Bootstrap::init();
