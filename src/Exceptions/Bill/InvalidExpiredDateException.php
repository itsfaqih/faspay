<?php

namespace ItsFaqih\Faspay\Exceptions\Bill;

class InvalidExpiredDateException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Expired date can\'t be less than the transaction date.');
    }
}
