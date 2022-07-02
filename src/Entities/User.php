<?php

namespace ItsFaqih\Faspay\Entities;

class User
{
    public $userId;
    public $password;
    public $merchantId;
    public $merchantName;
    public $credentials;
    public $merchant;

    public function __construct(string $userId, string $password, string $merchantId, string $merchantName)
    {
        $this->password = $password;
        $this->merchantId = $merchantId;
        $this->merchantName = $merchantName;

        $this->credentials = new Credentials($userId, $password);
        $this->merchant = new Merchant($merchantId, $merchantName);
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
