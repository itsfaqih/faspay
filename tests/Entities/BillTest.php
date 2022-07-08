<?php

use ItsFaqih\Faspay\Entities\Bill;

it('can create bill object from an array', function () {
    $bill = Bill::fromArray([
            'number' => 'TRX-123',
            'date' => new \DateTime(),
            'expired' => (new \DateTime())->modify('+1 day'),
            'description' => 'Red Shoes with special price',
            'total' => '250000',
        ]);

    expect($bill)->toBeInstanceOf(Bill::class);
    expect($bill->number)->toBe('TRX-123');
    expect($bill->date)->toBeInstanceOf(\DateTime::class);
    expect($bill->expired)->toBeInstanceOf(\DateTime::class);
    expect($bill->description)->toBe('Red Shoes with special price');
    expect($bill->total)->toBe('250000');
});
