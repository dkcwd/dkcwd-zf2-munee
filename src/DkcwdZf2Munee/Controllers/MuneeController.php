<?php
/** 
 * DkcwdMunee is a ZF2 module which brings the joy of Cody Lundquist's asset optimisation
 * library called 'Munee' to ZF2 applications.
 *  
 * It is easy to implement and avoids the need for a munee.php file by using a custom route
 * with a single controller while providing some simple ZF2 view helpers for additional 
 * convenience when leveraging the functionality provided.
 * 
 * View Helper
 * 
 * MuneeCss - used to generate a string which will call the custom route to handle css
 * Example usage: 
 * echo $this->MuneeCss(array(
 *     '/css/bootstrap-responsive.min.css', 
 *     '/css/style.css', 
 *     '/css/bootstrap.min.css'
 *     ),
 *     false // optional, if you do want the css to be minified then leave this param out 
 * );
 * 
 * MuneeImg - used to generate a string which will call the custom route to handle images
 * Example usage: 
 * echo $this->MuneeImg(
 *     'path-to-file.jpg', 
 *     'width[100]-height[50]', 
 *     array('atributeKey' => 'attributeValue') // optional, the default is null     
 * );
 * 
 * MuneeJs - used to generate a string which will call the custom route to handle css
 * Example usage: 
 * echo $this->MuneeJs(array(
 *     '/css/bootstrap-responsive.min.css', 
 *     '/css/style.css', 
 *     '/css/bootstrap.min.css'
 *     ),
 *     false // optional, if you do want the js to be minified then leave this param out 
 * );
 * 
 * The canonical source repository link for Munee by Cody Lundquist is: 
 * https://github.com/meenie/munee 
 * 
 * An extract taken from the source repository readme file describes Munee as a PHP5.3 
 * library to easily run all CSS through lessphp (LESS), resize/manipulate images 
 * on the fly, minify CSS and JS, and cache assets locally and remotely for 
 * lightening fast requests.
 * 
 * @link http://github.com/dkcwd/DkcwdMunee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au 
 * @copyright Dave Clark 2012
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2Munee\Controllers;

use \Zend\Mvc\Controller\AbstractActionController;
use \munee\Dispatcher;
use \munee\Request;

/**
 * A controller to make use of Munee by Cody Lunquist in a ZF2 module.
 * This controller combined with the custom route replaces the requirement 
 * for adding the recommended munee.php file to the web root and simply uses the  
 * strategy which Cody came up with.  He output the return value of the munee 
 * Dispatcher object run() method based on the munee Request object property 
 * values supplied to the Dispatcher object constructor.   
 *
 * @author Dave Clark
 */
class MuneeController extends AbstractActionController
{
    /**
     * Directly outputs the return value of the munee Dispatcher object
     * run() method to emulate the approach originally used by Cody Lundquist.
     * 
     * @return void     
     */
    public function muneeAction()
    {         
        echo Dispatcher::run(new Request());
    }
}