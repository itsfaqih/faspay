<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Enums\PaymentChannel as PaymentChannelEnum;

class PaymentChannel
{
    public string $code;
    public string $name;
    public PaymentChannelEnum $enum;

    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
        $this->enum = PaymentChannelEnum::from($code);
    }
}
