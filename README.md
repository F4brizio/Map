# Map - map for PHP

[![Total Downloads](https://img.shields.io/packagist/dt/F4brizio/map-php.svg)](https://packagist.org/packages/fabrizio/map-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/fabrizio/map-php.svg)](https://packagist.org/packages/fabrizio/map-php)

## Installation

Install the latest version with

```bash
$ composer require fabrizio/map-php
```

## Basic Usage

```php
<?php

use Fabrizio\Map\Map;

// create map
$map = new Map(xClass::class, OtherClass::class);

$xclass = new xClass();
$oclass = new OtherClass();

// put key & value
$map->put($xclass,$oclass);

// get value using key
var_dump($map->get($xclass));

```

### Author

F4brizio - <f4brizio.21@gmail.com><br />

### License

Monolog is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
