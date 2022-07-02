<?php

namespace ItsFaqih\Faspay\Exceptions\Payment;

class IncompatiblePaymentMethodException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Payment channel is not compatible with this payment type.');
    }
}
