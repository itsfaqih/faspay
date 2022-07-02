<?php

namespace ItsFaqih\Faspay\Exceptions\Payment;

class InvalidIdLengthException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Merchant\'s ID length must be 5.');
    }
}
