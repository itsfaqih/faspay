<?php

namespace ItsFaqih\Faspay\Enums;

use MyCLabs\Enum\Enum;

final class PaymentType extends Enum
{
    private const FULL_SETTLEMENT = '1';
    private const INSTALLMENT = '2';
    private const MIXED = '3';
}
