<?php

namespace ItsFaqih\Faspay\Contracts;

use ItsFaqih\Faspay\Interfaces\Response as ResponseInterface;

class Response implements ResponseInterface
{
    protected $stringResponse;

    public function __construct(string $stringResponse)
    {
        $this->stringResponse = $stringResponse;

        $this->handle();
    }

    public function handle(): void
    {
        //
    }
}
