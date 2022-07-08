<?php

use ItsFaqih\Faspay\Entities\Shipping;

it('can create shipping object from an array', function () {
    $shipping = Shipping::fromArray([
                'name' => 'Faqih',
                'lastName' => 'Muntashir',
                'address' => 'Jl. Raya',
                'city' => 'Sleman',
                'region' => 'Daerah Istimewa Yogyakarta',
                'state' => 'Indonesia',
                'postalCode' => '12345',
                'countryCode' => 'ID',
                'phone' => '081234567890',
        ]);

    expect($shipping)->toBeInstanceOf(Shipping::class);
    expect($shipping->name)->toBe('Faqih');
    expect($shipping->lastName)->toBe('Muntashir');
    expect($shipping->address)->toBe('Jl. Raya');
    expect($shipping->city)->toBe('Sleman');
    expect($shipping->region)->toBe('Daerah Istimewa Yogyakarta');
    expect($shipping->state)->toBe('Indonesia');
    expect($shipping->postalCode)->toBe('12345');
    expect($shipping->countryCode)->toBe('ID');
    expect($shipping->phone)->toBe('081234567890');
});
