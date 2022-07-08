<?php

use ItsFaqih\Faspay\Entities\User;

it('can create user object from an array', function () {
    $user = User::fromArray([
                'userId' => '12345',
                'password' => 'p@ssw0rd',
                'merchantId' => '12345',
                'merchantName' => 'FASPAY',
        ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->userId)->toBe('12345');
    expect($user->password)->toBe('p@ssw0rd');
    expect($user->merchantId)->toBe('12345');
    expect($user->merchantName)->toBe('FASPAY');
});
