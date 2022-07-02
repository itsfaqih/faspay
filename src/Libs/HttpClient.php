<?php

namespace ItsFaqih\Faspay\Libs;

use GuzzleHttp\Client;
use ItsFaqih\Faspay\Enums\Environment;

class HttpClient extends Client
{
    public function __construct(Environment $environment, array $config = [])
    {
        $baseUrl = [
            ((Environment::PRODUCTION())->getValue()) => 'https://web.faspay.co.id',
            ((Environment::DEVELOPMENT())->getValue()) => 'https://debit-sandbox.faspay.co.id',
        ];

        parent::__construct(array_merge([
            'base_uri' => $baseUrl[$environment->getValue()],
        ], $config));
    }
}
