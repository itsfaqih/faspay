<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;

class Shipping extends Entity
{
    public string $name;
    public ?string $lastName;
    public ?string $address;
    public ?string $city;
    public ?string $region;
    public ?string $state;
    public ?string $postalCode;
    public ?string $countryCode;
    public ?string $phone;

    public static array $requiredKeys = [
        'name',
    ];

    public function __construct(
        string $name,
        ?string $lastName = null,
        ?string $address = null,
        ?string $city = null,
        ?string $region = null,
        ?string $state = null,
        ?string $postalCode = null,
        ?string $countryCode = null,
        ?string $phone = null
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->region = $region;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
        $this->phone = $phone;
    }

    public static function fromArray(array $data): Shipping
    {
        self::validateArrayData($data);

        return new static(
            $data['name'],
            $data['lastName'] ?? null,
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['region'] ?? null,
            $data['state'] ?? null,
            $data['postalCode'] ?? null,
            $data['countryCode'] ?? null,
            $data['phone'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'receiver_name_for_shipping' => $this->name,
            'shipping_last_name' => $this->lastName,
            'shipping_address' => $this->address,
            'shipping_address_city' => $this->city,
            'shipping_address_region' => $this->region,
            'shipping_address_state' => $this->state,
            'shipping_address_poscode' => $this->postalCode,
            'shipping_address_country_code' => $this->countryCode,
            'shipping_msisdn' => $this->phone,
        ], function ($value) {
            return $value !== null;
        });
    }
}
