# Unofficial Faspay SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/itsfaqih/faspay.svg?style=flat-square)](https://packagist.org/packages/itsfaqih/faspay)
[![Tests](https://github.com/itsfaqih/faspay/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/itsfaqih/faspay/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/itsfaqih/faspay.svg?style=flat-square)](https://packagist.org/packages/itsfaqih/faspay)

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
