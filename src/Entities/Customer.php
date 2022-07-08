<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;

class Customer extends Entity
{
    public string $number;
    public string $name;
    public string $phone;
    public string $email;

    public static array $requiredKeys = [
        'number',
        'name',
        'phone',
        'email',
    ];

    public function __construct(string $number, string $name, string $phone, string $email)
    {
        $this->number = $number;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public static function fromArray(array $data): Customer
    {
        self::validateArrayData($data);

        return new static(
            $data['number'],
            $data['name'],
            $data['phone'],
            $data['email']
        );
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
