<?php

namespace ItsFaqih\Faspay\Contracts;

use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Interfaces\Request as RequestInterface;
use ItsFaqih\Faspay\Libs\HttpClient;

class Request implements RequestInterface
{
    protected $user;
    protected $httpClient;
    private $environment;
    private $httpConfig;

    public function __construct(User $user, Environment $environment)
    {
        $this->user = $user;
        $this->environment = $environment;
        $this->httpClient = new HttpClient($environment);
        $this->httpConfig = [];
    }

    public function setConfig(array $config): array
    {
        $this->httpClient = new HttpClient($this->environment, $config);

        return $this->httpConfig = $config;
    }

    public function getConfig(): array
    {
        return $this->httpConfig;
    }

    public function getPayload(): array
    {
        return [];
    }

    public function handle(): ?Response
    {
        return null;
    }
}
