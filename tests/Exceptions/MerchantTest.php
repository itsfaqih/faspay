<?php

use ItsFaqih\Faspay\Entities\Merchant;
use ItsFaqih\Faspay\Exceptions\Payment\InvalidIdLengthException;

it('can\'t create merchant object with id\'s length greater than 5', function () {
    new Merchant('123456', 'FASPAY');
})
    ->throws(InvalidIdLengthException::class);
