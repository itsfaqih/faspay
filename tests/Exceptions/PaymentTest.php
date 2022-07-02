<?php

use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Exceptions\Payment\IncompatiblePaymentMethodException;

it('can\'t create payment object with incompatible payment type', function ($paymentChannel, $paymentType) {
    new Payment($paymentChannel, $paymentType);
})
    ->with(
        array_filter(PaymentChannel::values(), function (PaymentChannel $paymentChannel) {
            return ! $paymentChannel->equals(PaymentChannel::BCA_KLIKPAY());
        })
    )
        ->with([
            (PaymentType::INSTALLMENT())->getKey() => PaymentType::INSTALLMENT(),
            (PaymentType::MIXED())->getKey() => PaymentType::MIXED(),
        ])
    ->throws(IncompatiblePaymentMethodException::class);
