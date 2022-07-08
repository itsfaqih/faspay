<?php

namespace ItsFaqih\Faspay\Contracts;

class Entity
{
    public static array $requiredKeys = [];

    public static function validateArrayData(array $data): void
    {
        foreach (self::$requiredKeys as $key) {
            if (! array_key_exists($key, $data)) {
                throw new \InvalidArgumentException("Missing key '{$key}'");
            }
        }
    }
}
