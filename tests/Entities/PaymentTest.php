<?php

use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;

it('can create payment object from an array', function () {
    $payment = Payment::fromArray([
        'channel' => PaymentChannel::BCA_KLIKPAY(),
                'type' => PaymentType::INSTALLMENT(),
    ]);

    expect($payment)->toBeInstanceOf(Payment::class);
    expect($payment->channel->getValue())->toBe((PaymentChannel::BCA_KLIKPAY())->getValue());
    expect($payment->type->getValue())->toBe((PaymentType::INSTALLMENT())->getValue());
});
