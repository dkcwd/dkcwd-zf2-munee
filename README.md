Use munee to optimise assets in your ZF2 Application
====================================================

---

Maintenance Status for DkcwdZf2Munee: [![project status](http://stillmaintained.com/dkcwd/dkcwd-zf2-munee.png)](http://stillmaintained.com/dkcwd/dkcwd-zf2-munee)

Build Status for DkcwdZf2Munee: [![Build Status](https://travis-ci.org/dkcwd/dkcwd-zf2-munee.png?branch=master)](https://travis-ci.org/dkcwd/dkcwd-zf2-munee)

Build Status for Munee by Cody Lundquist: [![Build Status](https://secure.travis-ci.org/meenie/munee.png?branch=master)](http://travis-ci.org/meenie/munee)

Purpose of the module
---------------------
DkcwdZf2Munee is a Zend Framework 2 (ZF2) module which brings the joy of '[munee](http://github.com/meenie/munee)', an asset optimisation library developed by Cody Lundquist, to ZF2 applications.
It is easy to implement and provides access to the features of [munee](http://github.com/meenie/munee) through 3 ZF2 view helpers, 1 custom route and 1 simple controller.

Features of the module
----------------------
 
+ 3 ZF2 view helpers to correctly format munee requests
+ 1 custom route to send munee requests to the munee controller
+ 1 simple controller to handle munee requests

What is Munee?
--------------

A PHP5.3 library developed by Cody Lundquist to easily run all CSS through [lessphp](http://leafo.net/lessphp/) ([LESS](http://lesscss.org/)), resize/manipulate images on the fly, minify CSS and JS, and cache assets locally and remotely for lightening fast requests.  See http://github.com/meenie/munee for more information.  Some of the information below has been directly taken from the munee source repository. 


Requirements
------------

+ PHP5.3.3+
+ Composer for installing and updating all dependencies
+ A Zend Framework 2 application you can use to work with the module 


[Composer](https://packagist.org/) Installation Instructions
------------------------------------------------------------

Just for reference when using Composer, if you have a slow connection consider using `COMPOSER_PROCESS_TIMEOUT=4000` prior to any `php composer.phar` commands to avoid a `[Symfony\Component\Process\Exception\RuntimeException] The process timed out` error.  For example you may want to use `COMPOSER_PROCESS_TIMEOUT=4000 php composer.phar update` instead of `php composer.phar update`.

### If you have a Zf2 project set up which you can use ###

1. Go to your main ZF2 application `composer.json` file and add `"dkcwd/dkcwd-zf2-munee": "1.2.*"` so as an example, if you are using the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication) and if no other requirements are meant to be specified in your main composer.json file, the composer.json file should be updated to look like this:

		{
			"name": "zendframework/skeleton-application",
			"description": "Skeleton Application for ZF2",
			"license": "BSD-3-Clause",
			"keywords": [
				"framework",
				"zf2"
			],    
			"homepage": "http://framework.zend.com/",			
			"require": {
				"php": ">=5.3.3",
				"zendframework/zendframework": "2.*",
				"dkcwd/dkcwd-zf2-munee": "1.2.*"
			}
		}  

1. Run `curl -s http://getcomposer.org/installer | php`
1. Run `php composer.phar update`
1. Once the installation is complete go to your ZF2 `application.config.php` file and add `'DkcwdZf2Munee'` to the list of modules.  As an example assuming no other modules are in use except for the `Application` module which comes with the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication) it would look like this:

		<?php
		return array(
			'modules' => array(
				'Application',
				'DkcwdZf2Munee'
			),
			'module_listener_options' => array(
				'config_glob_paths'    => array(
					'config/autoload/{,*.}{global,local}.php',
				),
				'module_paths' => array(
					'./module',
					'./vendor',
				),
			),
		);
1. Make sure the `cache` folder inside `vendor/meenie/munee` is writable or else it won't work

### If you do not have a Zf2 project set up which you can use ###

1. cd to the directory you want to create your new ZF2 project in
1. Run `curl -s https://getcomposer.org/installer | php`
1. Run `php composer.phar create-project --repository-url="http://packages.zendframework.com" zendframework/skeleton-application full/path/to/new/project/project-name`
1. You may want to run `php composer.phar self-update` if you saw a warning message
1. Go to the `composer.json` file in the top level of your new ZF2 project folder and make it look like this:

		{
			"name": "zendframework/skeleton-application",
			"description": "Skeleton Application for ZF2",
			"license": "BSD-3-Clause",
			"keywords": [
				"framework",
				"zf2"
			],    
			"homepage": "http://framework.zend.com/",			
			"require": {
				"php": ">=5.3.3",
				"zendframework/zendframework": "2.*",
				"dkcwd/dkcwd-zf2-munee": "1.2.*"
			}
		}  

1. Run `php composer.phar update`
1. Once the installation is complete go to your ZF2 `application.config.php` file and add `'DkcwdZf2Munee'` to the list of modules.  As an example assuming no other modules are in use except for the `Application` module which comes with the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication) it would look like this:

		<?php
		return array(
			'modules' => array(
				'Application',
				'DkcwdZf2Munee'
			),
			'module_listener_options' => array(
				'config_glob_paths'    => array(
					'config/autoload/{,*.}{global,local}.php',
				),
				'module_paths' => array(
					'./module',
					'./vendor',
				),
			),
		);
1. Make sure the `cache` folder inside `vendor/meenie/munee` is writable or else it won't work		

Usage Instructions
------------------

### View Helpers ###

The functionality provided by munee is accessed using view helpers in your ZF2 application view scripts. There are 3 view helpers:

+ MuneeCss($arrayOfCssFiles, $minify = true) for working with CSS files
+ MuneeImg($pathToImage, $resizeParams, $anyAdditionalHtmlAttibutes = null) for working with images
+ MuneeJs($arrayOfJsFiles, $minify = true) for working with Js files

The most likely place you will use the CSS and Js view helpers is within your layout script for generating a correctly formatted link to aggregate all your css and javascript files. 


**MuneeCss: One Request For All CSS with auto minification**

All LESS files are automatically compiled through lessphp and cached, there is nothing extra that you need to do. Any changes you make to your CSS, even LESS files you have @import will automatically recreate the cache, invalidate the client side cache, and force the browser to download the newest version.

Example usage: In your view script do

    echo $this->muneeCss(array('/css/style.css', '/css/other-style.css'));
to output a formatted stylesheet link which will allow all css files specified to be handled and minified in one request, alternatively you can do
    
	echo $this->muneeCss(array('/css/style.css', '/css/other-style.css'), false);    
for the same result but without minification.


**MuneeImg: Handling/Resizing Images**

Using Munee, you resize/crop/stretch/fill images on-the-fly using a set of parameters.  The resulting image will be cached and served up on subsequent requests.  If the source image is modified, it will recreate the cache then invalidate the client side cache and force the browser to download the newest version.

Example usage: In your view script do

    echo $this->muneeImg('path-to-image.jpg', 'w[100]h[100]');
to output a formatted request using the chosen resize parameters.  You can specify any additional image attributes such as an id or class by supplying an array full of key value pairs as a third parameter like this: `array('class' => 'myImageClass', 'rel' => 'someTrigger')`         

Resize Parameters - Parameters can either be in long form or use their shortened form.  The value for an alias must be wrapped in square brackets `[]`. There is no need to put any characters between each parameter, although you can if you want.

+ `height` (or `h`) - The max height you want the image. Value must be an integer.
+ `width` (or `w`) - The max width you want the image. Value must be an integer.
+ `exact` (or `e`) - Crop the image to the exact `height` and `width`. Value can be `true` or `false`.
+ `stretch` (or `s`) - Stretch the image to match the exact `height` and `width`. Value can be `true` or `false`.
+ `fill` (or `f`) - Draw a background the exact size of the `height` and `width` and centre the image in the middle. (If you do not want the image to be stretched, then do not use the `stretch` parameter along with `fill`). Value can be `true` or `false`.
+ `fillColour` (or `fc`) - The colour of the background. Default is `FFFFFF` (white).  This can be any hex colour (i.e. `FF0000`)
+ `quality` (or `q`) - JPEG compression value. Default is: `75` - It will only work for JPEG's.


**MuneeJs: One Request For All JS with auto minification**

All JavaScript is served through Munee so that it can handle the client side caching.

Example usage: In your view script do

    echo $this->muneeJs(array('/js/script1.js', '/js/script2.js'));
to output a formatted script link which will allow all js files specified to be handled and minified in one request, alternatively you can do

    echo $this->muneeCss(array('/js/script1.js', '/js/script2.js'), false);    
for the same result but without minification.

Hope you enjoy using this module :-)
