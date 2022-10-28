# Random teapot 

This is a Symfony bundle which replaces some requests with error 418 - I'm a teapot. 
You can specify what percentage of random picked request will be replaced by error 418

# Valuable partners:

![PhpStorm logo](https://resources.jetbrains.com/storage/products/company/brand/logos/PhpStorm.svg)

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require fabricio872/random-teapot-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require fabricio872/random-teapot-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php
return [
    // ...
    Fabricio872\RandomTeapotBundle\RandomTeapotBundle::class => ['all' => true],
];
```

## Configuration options
```yaml
# config/services.yaml

# ...

# Default configuration for extension with alias: "random_teapot"
random_teapot:

    # Define how often should error 418 be given. (0.01 is 1% of all requests)
    randomness:           0.01

    # Set filter for paths you want this to be applied
    path_filter:          '*'

    # Change default template for 418 error
    template:             '@RandomTeapot/i_am_a_teapot.html.twig'

# ...
```

 Path filter is using bash wildcards to define multiple paths [learn more](https://ryanstutorials.net/linuxtutorial/wildcards.php)