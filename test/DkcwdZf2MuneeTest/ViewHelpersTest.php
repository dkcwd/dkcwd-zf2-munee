<?php
/**
 * @link http://github.com/dkcwd/dkcwd-zf2-munee for the canonical source repository
 * @author Dave Clark dave@dkcwd.com.au
 * @copyright (c) Dave Clark 2012 (https://www.dkcwd.com.au)
 * @license http://opensource.org/licenses/mit-license.php
 */

namespace DkcwdZf2MuneeTest;

use PHPUnit_Framework_TestCase as TestCase;
use \DkcwdZf2Munee\View\Helpers\MuneeCss;
use \DkcwdZf2Munee\View\Helpers\MuneeImg;
use \DkcwdZf2Munee\View\Helpers\MuneeJs;

/**
 * Unit tests for DkcwdZf2Munee\View\Helpers view helpers:
 * MuneeCss
 * MuneeImg
 * MuneeJs
 */
class ViewHelpersTest extends TestCase
{
    public function setUp() {}

    public function tearDown() {}    
    
    public function testMuneeCssWorksWithValidParameters()
    {       
        $MuneeCss = new MuneeCss;
        
        // Where an array containing string values is passed as the first param and no second param is passed
        $result = $MuneeCss(array('/css/style.css', '/css/mystyle.css'));        
        $this->assertSame(
                '<link rel="stylesheet" href="/munee?files=/css/style.css,/css/mystyle.css&minify=true">' . PHP_EOL, 
                $result
        );
        
        // Where an array containing one string value is passed as the first param and no second param is passed
        $result = $MuneeCss(array('/css/style.css'));
        $this->assertSame(
                '<link rel="stylesheet" href="/munee?files=/css/style.css&minify=true">' . PHP_EOL,
                $result
        );
        
        // Where an array containing string values is passed as the first param and a second param is passed
        $result = $MuneeCss(array('/css/style.css', '/css/mystyle.css'), false);
        $this->assertSame(
                '<link rel="stylesheet" href="/munee?files=/css/style.css,/css/mystyle.css&minify=false">' . PHP_EOL,
                $result
        );
        
        // Where an array containing string values is passed as the first param and no element wrapper is desired
        $result = $MuneeCss(array('/css/style.css', '/css/mystyle.css'), false, false);
        $this->assertSame(
                '/munee?files=/css/style.css,/css/mystyle.css&minify=false' . PHP_EOL,
                $result
        );
        
    }
    
    public function testMuneeCssDoesNotGenerateStylesheetLinkIfFirstParamIsNotAnArrayAndTheArrayDoesNotContainAtLeastOneStringValue()
    {
        $MuneeCss = new MuneeCss;
    
        // Where a string is passed as the first parameter instead of an array
        $result = $MuneeCss('/style.css');
        $this->assertSame(
                null,
                $result
        );   

        // Where an array is passed as the first parameter and no string values are held by the array
        $result = $MuneeCss(array(new \stdClass()));
        $this->assertSame(
                null,
                $result
        );
    
    }
    
    public function testMuneeImgWorksWithValidParameters()
    {
        $MuneeImg = new MuneeImg;
    
        // File path as first parameter, params passed as second param no array of attributes
        $result = $MuneeImg('/myimage.jpg', 'width[100]-height[50]'); 
        $this->assertSame(
                '<img src="/munee?files=/myimage.jpg&resize=width[100]-height[50]" >' . PHP_EOL,
                $result
        );
        
        // File path as first parameter, params passed as second param plus array of attributes
        $result = $MuneeImg('/myimage.jpg', 'width[100]-height[50]', array('class' => 'someclass'));
        $this->assertSame(
                '<img src="/munee?files=/myimage.jpg&resize=width[100]-height[50]" class="someclass" >' . PHP_EOL,
                $result
        );
    
    }
    
    public function testMuneeImgDoesNotGenerateImageLinkIfImagePathOrMuneeImageResizeParametersAreNotSuppliedAsStrings()
    {
        $MuneeImg = new MuneeImg;
    
        // Array instead of string as first parameter, string of params passed as second param no array of attributes
        $result = $MuneeImg(array('string-value-inside-an-array'), 'width[100]-height[50]');
        $this->assertSame(
                null,
                $result
        );
        
        // File path as first parameter, string of params passed as second param no array of attributes
        $result = $MuneeImg('/myimage.jpg', array('string-value-inside-an-array'));
        $this->assertSame(
                null,
                $result
        );
    
    }
    
    public function testMuneeJsWorksWithValidParameters()
    {
        $MuneeJs = new MuneeJs;
    
        // Where an array containing string values is passed as the first param and no second param is passed
        $result = $MuneeJs(array('/myscript1.js', '/myscript2.js'));
        $this->assertSame(
                '<script src="/munee?files=/myscript1.js,/myscript2.js&minify=true"></script>' . PHP_EOL,
                $result
        );
                
        // Where an array containing one string value is passed as the first param and no second param is passed
        $result = $MuneeJs(array('/myscript.js'));
        $this->assertSame(
                '<script src="/munee?files=/myscript.js&minify=true"></script>' . PHP_EOL,
                $result
        );
    
        // Where an array containing string values is passed as the first param and a second param is passed
        $result = $MuneeJs(array('/myscript1.js', '/myscript2.js'), false);
        $this->assertSame(
                '<script src="/munee?files=/myscript1.js,/myscript2.js&minify=false"></script>' . PHP_EOL,
                $result
        );
        
        // Where an array containing string values is passed as the first param and no element wrapper is desired
        $result = $MuneeJs(array('/myscript1.js', '/myscript2.js'), false, false);
        $this->assertSame(
                '/munee?files=/myscript1.js,/myscript2.js&minify=false' . PHP_EOL,
                $result
        );
    
    }
    
    public function testMuneeJsDoesNotGenerateScriptLinkIfFirstParamIsNotAnArrayAndTheArrayDoesNotContainAtLeastOneStringValue()
    {
        $MuneeJs = new MuneeJs;
    
        // Where a string is passed as the first parameter instead of an array
        $result = $MuneeJs('/myscript.js');
        $this->assertSame(
                null,
                $result
        );
    
        // Where an array is passed as the first parameter and no string values are held by the array
        $result = $MuneeJs(array(new \stdClass()));
        $this->assertSame(
                null,
                $result
        );
    
    }    

}
