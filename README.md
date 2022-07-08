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
Configure the credentials and the client.

```php
use ItsFaqih\Faspay\Client;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;

$user = new User('bot98765', 'p@ssw0rd', '98765', 'FASPAY');

$faspayClient = new Client($user, Environment::DEVELOPMENT());
```

### Payment Channel Inquiry
```php
$faspayClient->paymentChannelInquiry();
```

### Post Data Transaction
```php
use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;

$bill = new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('+1 day'), 'Red Shoes with special price', '250000');
$payment = new Payment(PaymentChannel::LINK_AJA(), PaymentType::FULL_SETTLEMENT());
$customer = new Customer('001', 'John Smith', '08123456789', 'john.smith@example.com');
$item = new BillItem('Red Shoes', 1, '250000');

$faspayClient->postDataTransaction($bill, $payment, $customer, [$item]);
```

### Inquiry Payment Status
```php
$trxId = '9876530200004184';
$billNo = 'TRX-123';

$faspayClient->inquiryPaymentStatus($trxId, $billNo);
```

### Cancel Transaction
```php
$trxId = '9876530200004184';
$billNo = 'TRX-123';
$reason = 'Wrong order';

$faspayClient->cancelTransaction($trxId, $billNo, $reason);
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
