<?php

use ItsFaqih\Faspay\Entities\Billing;

it('can create billing object from an array', function () {
    $billing = Billing::fromArray([
        'name' => 'Faqih',
        'lastName' => 'Its',
        'address' => 'Jl. Raya',
        'city' => 'Jakarta',
        'region' => 'Jakarta',
        'state' => 'Jakarta',
        'postalCode' => '12345',
        'countryCode' => 'ID',
    ]);

    expect($billing)->toBeInstanceOf(Billing::class);
    expect($billing->name)->toBe('Faqih');
    expect($billing->lastName)->toBe('Its');
    expect($billing->address)->toBe('Jl. Raya');
    expect($billing->city)->toBe('Jakarta');
    expect($billing->region)->toBe('Jakarta');
    expect($billing->state)->toBe('Jakarta');
    expect($billing->postalCode)->toBe('12345');
    expect($billing->countryCode)->toBe('ID');
});
