<?php

namespace ItsFaqih\Faspay\Interfaces;

use ItsFaqih\Faspay\Contracts\Response;

interface Request
{
    public function setConfig(array $config): array;

    public function getConfig(): array;

    public function getPayload(): array;

    public function handle(): ?Response;
}
