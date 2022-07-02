<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Exceptions\General\NotNumericException;

class BillItem
{
    public $name;
    public $quantity;
    public $price;
    public $paymentType;
    public $tenor;
    public $merchantId;

    public function __construct(string $name, int $quantity, int|string $price, ?PaymentType $paymentType = null, ?string $tenor = '00', ?string $merchantId = null)
    {
        if (! is_numeric($price)) {
            throw new NotNumericException('Price');
        }

        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->paymentType = $paymentType;
        $this->tenor = $tenor;
        $this->merchantId = $merchantId;

        if (empty($this->paymentType)) {
            $this->paymentType = PaymentType::FULL_SETTLEMENT();
        }
    }

    public function toArray(): array
    {
        return array_filter([
            'product' => $this->name,
            'qty' => $this->quantity,
            'amount' => $this->price,
            'payment_plan' => $this->paymentType->getValue(),
            'merchant_id' => $this->merchantId,
            'tenor' => $this->tenor,
        ], function ($value) {
            return $value !== null;
        });
    }
}
