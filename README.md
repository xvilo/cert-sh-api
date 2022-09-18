## crt.sh API client in PHP

This is a small API client/wrapper around the https://crt.sh Certificate Transparency website. It's written in PHP and
uses the PSR HTTP client component as a base. 

### Installation
You can install this library through composer, using the following command:
```
$ composer require xvilo/crt-sh-api
```

### Usage

Example usage would be:
```php
<?php

declare(strict_types=1);

include 'vendor/autoload.php';

$client = new \Xvilo\CrtShApi\CrtSh();
foreach ($client->search('google.com') as $result) {
    echo $result->getCommonName() . ' ' . $result->getNotBefore()->format('Y-m-d') . PHP_EOL;
}
```
