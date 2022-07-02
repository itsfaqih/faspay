<?php

namespace ItsFaqih\Faspay\Exceptions\General;

class NotNumericException extends \Exception
{
    public function __construct($variable)
    {
        parent::__construct("$variable must be numeric.");
    }
}
