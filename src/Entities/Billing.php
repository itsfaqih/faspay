<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;

class Billing extends Entity
{
    public string $name;
    public ?string $lastName;
    public ?string $address;
    public ?string $city;
    public ?string $region;
    public ?string $state;
    public ?string $postalCode;
    public ?string $countryCode;

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
        ?string $countryCode = null
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->region = $region;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }

    public static function fromArray(array $data): Billing
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
            $data['countryCode'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'billing_name' => $this->name,
            'billing_last_name' => $this->lastName,
            'billing_address' => $this->address,
            'billing_address_city' => $this->city,
            'billing_address_region' => $this->region,
            'billing_address_state' => $this->state,
            'billing_address_poscode' => $this->postalCode,
            'billing_address_country_code' => $this->countryCode,
        ], function ($value) {
            return $value !== null;
        });
    }
}
