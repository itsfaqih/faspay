<?php

namespace ItsFaqih\Faspay\Exceptions\Bill;

class InvalidCurrencyException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Currency must be IDR.');
    }
}
