DkcwdZf2Munee: Use munee for asset optimisation in your ZF2 Application
=======================================================================

---

Purpose of the module
---------------------
DkcwdMunee is a ZF2 module which brings the joy of 'munee', an asset optimisation library developed by Cody Lundquist, to ZF2 applications.
It is easy to implement and avoids the need for a munee.php file by using a custom route with a single controller while providing some simple ZF2 view helpers for additional convenience when leveraging the functionality provided by munee.

Features of the module
----------------------
 
+ 3 simple ZF2 view helpers to correctly format munee requests without needing to alter your .htaccess file
+ 1 custom route to handle munee requests

What is Munee?
--------------

A PHP5.3 library developed by Cody Lundquist to easily run all CSS through [lessphp](http://leafo.net/lessphp/) ([LESS](http://lesscss.org/)), resize/manipulate images on the fly, minify CSS and JS, and cache assets locally and remotely for lightening fast requests.  See http://github.com/meenie/munee for more information.  Some of the information below has been directly taken from the munee source repository. 


Requirements
------------

+ PHP5.3.3+
+ A Zend Framework 2 application you can use to work with the module
+ Composer for managing the installation and updating of dependencies 


[Composer](https://packagist.org/) Installation Instructions
------------------------------------------------------------

1. Go to your main ZF2 application `composer.json` file and add
"dkcwd/DkcwdZf2Munee": "*" to the require section.
1. Run `curl -s http://getcomposer.org/installer | php`
1. Run `php composer.phar install`
1. Make sure the `cache` folder inside `vendor/meenie/munee` is writable
1. Once the installation is complete go to your ZF2 application.config.php file and add 'DkcwdZf2Munee' to the list of modules


Usage Instructions
------------------

### View Helpers ###


**One Request For All CSS with auto minification**
All CSS is automatically compiled through LESS and cached, there is nothing extra that you need to do.  Any changes you make to your CSS, even LESS files you have `@import` will automatically recreate the cache invalidate the client side cache and force the browser to download the newest version.

In your view script call:

    echo $this->MuneeCss(array('/css/style.css', '/css/other-style.css'));
to output a formatted request which will allow all css files specified to be handled and minified in one request, alternatively 
    echo $this->MuneeCss(array('/css/style.css', '/css/other-style.css'), false);    
for the same result but without minification.


**Handling/Resizing Images**

Using Munee, you resize/crop/stretch/fill images on-the-fly using a set of parameters.  The resulting image will be cached and served up on subsequent requests.  If the source image is modified, it will recreate the cache and invalidate the client side cache and force the browser to download the newest version.
In your view script call:

    echo $this->MuneeImg('path-to-image.jpg', 'w[500]h[500]f[true]fc[444444]');
to output a formatted request using the chosen resize parameters.  You can specify any additional image attributes such as and id or class by supplying an array full of key value pairs as a third parameter.         

Resize Parameters - Parameters can either be in long form or use their shortened form.  The value for an alias must be wrapped in square brackets `[]`. There is no need to put any characters between each parameter, although you can if you want.

+ `height` (or `h`) - The max height you want the image. Value must be an integer.
+ `width` (or `w`) - The max width you want the image. Value must be an integer.
+ `exact` (or `e`) - Crop the image to the exact `height` and `width`. Value can be `true` or `false`.
+ `stretch` (or `s`) - Stretch the image to match the exact `height` and `width`. Value can be `true` or `false`.
+ `fill` (or `f`) - Draw a background the exact size of the `height` and `width` and centre the image in the middle. (If you do not want the image to be stretched, then do not use the `stretch` parameter along with `fill`). Value can be `true` or `false`.
+ `fillColour` (or `fc`) - The colour of the background. Default is `FFFFFF` (white).  This can be any hex colour (i.e. `FF0000`)
+ `quality` (or `q`) - JPEG compression value. Default is: `75` - It will only work for JPEG's.


**One Request For All JS with auto minification**
All JavaScript is served through Munee so that it can handle the client side caching.

In your view script call:

    echo $this->MuneeJs(array('/js/script1.js', '/js/script2.js'));
to output a formatted request which will allow all js files specified to be handled and minified in one request, alternatively 
    echo $this->MuneeCss(array('/js/script1.js', '/js/script2.js'), false);    
for the same result but without minification.