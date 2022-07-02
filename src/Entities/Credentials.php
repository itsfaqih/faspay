<?php

namespace ItsFaqih\Faspay\Entities;

class Credentials
{
    public $userId;
    public $password;

    public function __construct(string $userId, string $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }

    public function toSignature(string $additionalData = ''): string
    {
        return sha1(md5($this->userId . $this->password . $additionalData));
    }
}
