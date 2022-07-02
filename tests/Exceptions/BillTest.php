<?php

use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Exceptions\Bill\InvalidCurrencyException;
use ItsFaqih\Faspay\Exceptions\Bill\InvalidExpiredDateException;

it('can\'t create bill object with currency other than IDR', function () {
    new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('+1 day'), 'Red Shoes with special price', '250000', null, null, null, 'USD');
})
    ->throws(InvalidCurrencyException::class);

it('can\'t create bill object with expired date greater than transaction date', function () {
    new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('-1 day'), 'Red Shoes with special price', '250000');
})
    ->throws(InvalidExpiredDateException::class);
