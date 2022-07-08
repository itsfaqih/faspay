<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Exceptions\General\NotNumericException;

class BillItem extends Entity
{
    public string $name;
    public int $quantity;
    public string $price;
    public ?PaymentType $paymentType;
    public ?string $tenor;
    public ?string $merchantId;

    public static array $requiredKeys = [
        'name',
        'quantity',
        'price',
    ];

    public function __construct(string $name, int $quantity, string $price, ?PaymentType $paymentType = null, ?string $tenor = '00', ?string $merchantId = null)
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

    public static function fromArray(array $data): BillItem
    {
        self::validateArrayData($data);

        return new static(
            $data['name'],
            $data['quantity'],
            $data['price'],
            $data['paymentType'] ?? null,
            $data['tenor'] ?? '00',
            $data['merchantId'] ?? null
        );
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
