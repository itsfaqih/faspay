<?php

use ItsFaqih\Faspay\Client;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;

uses()->beforeEach(function () {
    $this->user = new User(
        'bot98765',
        'p@ssw0rd',
        '98765',
        'FASPAY'
    );

    $this->faspayClient = new Client(
        $this->user,
        Environment::DEVELOPMENT()
    );
})->in('Requests');
