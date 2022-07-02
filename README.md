# Unofficial Faspay SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
[![Tests](https://github.com/:vendor_slug/:package_slug/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/:vendor_slug/:package_slug/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require itsfaqih/faspay
```

## Usage

```php
use ItsFaqih\Faspay\Client;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;

$user = new User('bot98765', 'p@ssw0rd', '98765', 'FASPAY');

$faspayClient = new Client($user, Environment::DEVELOPMENT());

$response = $faspayClient->paymentChannelInquiry();

var_dump($response);
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
