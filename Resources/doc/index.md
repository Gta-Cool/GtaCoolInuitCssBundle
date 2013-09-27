GtaCoolInuitCssBundle Documentation
===================================

Hi guys, theGtaCoolInuitCssBundle allows you to add easily [inuit.css](https://github.com/csswizardry/inuit.css/) framework into an existent bundle or generate a new bundle with [inuit.css](https://github.com/csswizardry/inuit.css/) framework inside.

It permit you to start and create an html5 website directly with Symfony2.

<a name="toc"></a>
## Table of contents

  * [Installation](#installation)
    * [1. Download GtaCoolInuitCssBundle](#installation-download)
      * [You are using Symfony 2.0](#installation-symfony2.0)
      * [You are using Symfony 2.1+](#installation-symfony2.1)
    * [2. Enable the Bundle](#installation-enable)

<a name="installation"></a>
## Installation ##

<a name="installation-download"></a>
### 1. Download GtaCoolInuitCssBundle

<a name="installation-symfony2.0"></a>
#### You are using Symfony 2.0
The GtaCoolInuitCssBundle files should be added to the `vendor/bundles/GtaCool/Bundle/InuitCssBundle` directory.

This can be done by using the symfony vendor script.

Add the following lines inside your deps file:

    [GtaCoolInuitCssBundle]
        git=git://github.com/Gta-Cool/GtaCoolInuitCssBundle.git
        target=/bundles/GtaCool/Bundle/InuitCssBundle

Now, run the vendors script to add the bundle:

    $ php bin/vendors install

And proceed dependency installation with the following git command ("web" must be the name of your symfony web directory):

    $ git submodule add git://github.com/Gta-Cool/inuit.css.git web/components/inuit.css
    $ git submodule update --init

<a name="installation-symfony2.1"></a>
#### You are using Symfony 2.1+
The GtaCoolInuitCssBundle files should be added to the `vendor/gta-cool/inuitcss-bundle/GtaCool/Bundle/InuitCssBundle` directory.

This can be done by using the [Composer](http://getcomposer.org/) script.

Add the following lines inside your composer.json file ("web" must be the name of your symfony web directory):

```javascript
{
    "require": {
        "gta-cool/inuitcss-bundle": "5.0.*"
    },
    // ...
    "config": {
        "component-dir": "web/components",
        "component-baseurl": "/components"
    },
}
```

Update the vendor libraries:

    $ php composer.phar update gta-cool/inuitcss-bundle

<a name="installation-enable"></a>
### 2. Enable the Bundle
Enable the bundle in the kernel:

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new GtaCool\Bundle\InuitCssBundle\GtaCoolInuitCssBundle(),
	);
}
```
