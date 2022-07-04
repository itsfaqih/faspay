<?php

namespace ItsFaqih\Faspay\Entities;

class Billing
{
    public $name;
    public $lastName;
    public $address;
    public $city;
    public $region;
    public $state;
    public $postalCode;
    public $countryCode;

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
