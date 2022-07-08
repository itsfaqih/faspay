<?php

use ItsFaqih\Faspay\Entities\Customer;

it('can create customer object from an array', function () {
    $customer = Customer::fromArray([
        'number' => '21',
                'name' => 'John Smith',
                'phone' => '081234567890',
                'email' => 'john.smith@example.com',
    ]);

    expect($customer)->toBeInstanceOf(Customer::class);
    expect($customer->number)->toBe('21');
    expect($customer->name)->toBe('John Smith');
    expect($customer->phone)->toBe('081234567890');
    expect($customer->email)->toBe('john.smith@example.com');
});
