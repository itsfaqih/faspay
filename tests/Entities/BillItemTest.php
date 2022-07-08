<?php

use ItsFaqih\Faspay\Entities\BillItem;

it('can create bill item object from an array', function () {
    $billItem = BillItem::fromArray([
        'name' => 'Shoes',
        'quantity' => 1,
        'price' => 250000,
    ]);

    expect($billItem)->toBeInstanceOf(BillItem::class);
    expect($billItem->name)->toBe('Shoes');
    expect($billItem->quantity)->toBe(1);
    expect($billItem->price)->toBe('250000');
});
