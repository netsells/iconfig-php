# iConfig PHP client

This is the iConfig PHP SDK. This SDK contains methods for easily interacting 
with the iConfig API. 

[![StyleCI](https://styleci.io/repos/70829548/shield?branch=master)](https://styleci.io/repos/70829548)

## Installation

To install the SDK, you will need to be using [Composer](http://getcomposer.org/) 
in your project. 
If you aren't using Composer yet, it's really simple! Here's how to install 
composer:

```bash
curl -sS https://getcomposer.org/installer | php
```

The iConfig api client is not hard coupled to Guzzle or any other library that sends HTTP messages. It uses an abstraction 
called HTTPlug. This will give you the flexibilty to choose what PSR-7 implementation and HTTP client to use. 

If you just want to get started quickly you should run the following command: 

```bash
php composer.phar require netsells/iconfig-php php-http/curl-client guzzlehttp/psr7
```

### Why requiring so many packages?

iConfig PHP SDK has a dependency on the virtual package
[php-http/client-implementation](https://packagist.org/providers/php-http/client-implementation) which requires to you install **an** adapter, but we do not care which one. That is an implementation detail in your application. We also need **a** PSR-7 implementation and **a** message factory. 

You do not have to use the `php-http/curl-client` if you do not want to. You may use the `php-http/guzzle6-adapter`. Read more about the virtual packages, why this is a good idea and about the flexibility it brings at the [HTTPlug docs](http://docs.php-http.org/en/latest/httplug/users.html).