<?php
/**
 * DkcwdZf2Munee is a ZF2 module which brings the joy of Cody Lundquist's asset optimisation
 * library called 'munee' to ZF2 applications.
 *  
 * It is easy to implement and provides access to the features of munee through 3 ZF2 view 
 * helpers, 1 custom route and 1 simple controller.
 * 
 * View Helpers usage in view scripts
 * ----------------------------------
 * 
 * MuneeCss - used to generate a string which will call the custom route to handle css
 * Example usage: 
 * echo $this->muneeCss(array(
 *     '/css/bootstrap-responsive.min.css', 
 *     '/css/style.css', 
 *     '/css/bootstrap.min.css'
 *     ),
 *     false // optional, if you do want the css to be minified then leave this param out 
 * );
 * 
 * MuneeImg - used to generate a string which will call the custom route to handle images
 * Example usage: 
 * echo $this->muneeImg(
 *     'path-to-file.jpg', 
 *     'width[100]-height[50]', 
 *     array('atributeKey' => 'attributeValue') // optional, the default is null     
 * );
 * 
 * MuneeJs - used to generate a string which will call the custom route to handle js files
 * Example usage: 
 * echo $this->muneeJs(array(
 *     '/scripts/myscript.js', 
 *     '/scripts/myscript2.js', 
 *     '/scripts/myscript3.js'
 *     ),
 *     false // optional, if you do want the js to be minified then leave this param out 
 * );
 * 
 * @link http://github.com/dkcwd/dkcwd-zf2-munee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au
 * @copyright (c) Dave Clark 2012 (https://www.dkcwd.com.au)
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2Munee;

/**
 * Module class required for module to be initialized in ZF2 application
 */
class Module
{
    /**
     * Retrieve autoloader configuration for the module
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array('Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
            ),
        ));
    }  

    /**
     * Retrieve application configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
     * Register view helpers for this module
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        $path = 'DkcwdZf2Munee\View\Helpers\\';
        return array(
            'invokables' => array(
                'MuneeCss' => $path . 'MuneeCss',
                'MuneeImg' => $path . 'MuneeImg',
                'MuneeJs'  => $path . 'MuneeJs',
            ),
        );
    }

}
