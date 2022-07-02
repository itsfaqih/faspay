<?php

namespace ItsFaqih\Faspay\Entities;

class Customer
{
    public $number;
    public $name;
    public $phone;
    public $email;

    public function __construct(string $number, string $name, string $phone, string $email)
    {
        $this->number = $number;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'cust_no' => $this->number,
            'cust_name' => $this->name,
            'msisdn' => $this->phone,
            'email' => $this->email,
        ];
    }
}
