<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Exceptions\Payment\InvalidIdLengthException;

class Merchant
{
    private $id;
    private $name;

    public function __construct(string $id, string $name)
    {
        if (strlen($id) !== 5) {
            throw new InvalidIdLengthException();
        }

        $this->id = $id;
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'merchant_id' => $this->id,
            'merchant' => $this->name,
        ];
    }
}
