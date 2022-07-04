<?php

namespace ItsFaqih\Faspay\Entities;

class Shipping
{
    public $name;
    public $lastName;
    public $address;
    public $city;
    public $region;
    public $state;
    public $postalCode;
    public $countryCode;
    public $phone;

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
