<?php
/** 
 * @link http://github.com/dkcwd/dkcwd-zf2-munee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au 
 * @copyright Dave Clark 2012
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2Munee\Controllers;

use \Zend\Mvc\Controller\AbstractActionController;
use \Zend\View\Model\ViewModel;
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
        exit();
    }
}
