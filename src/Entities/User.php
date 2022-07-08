<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;

class User extends Entity
{
    public string $userId;
    public string $password;
    public string $merchantId;
    public string $merchantName;
    public Credentials $credentials;
    public Merchant $merchant;

    public static array $requiredKeys = [
        'userId',
        'password',
        'merchantId',
        'merchantName',
    ];

    public function __construct(string $userId, string $password, string $merchantId, string $merchantName)
    {
        $this->userId = $userId;
        $this->password = $password;
        $this->merchantId = $merchantId;
        $this->merchantName = $merchantName;

        $this->credentials = new Credentials($userId, $password);
        $this->merchant = new Merchant($merchantId, $merchantName);
    }

    public static function fromArray(array $data): User
    {
        self::validateArrayData($data);

        return new static(
            $data['userId'],
            $data['password'],
            $data['merchantId'],
            $data['merchantName']
        );
    }

    public function getSignature(string $additionalData = ''): string
    {
        return $this->credentials->toSignature($additionalData);
    }

    public function getMerchantArray(): array
    {
        return $this->merchant->toArray();
    }
}
