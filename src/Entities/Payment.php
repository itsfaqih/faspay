<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Exceptions\Payment\IncompatiblePaymentMethodException;

class Payment
{
    public $channel;
    public $type;

    public function __construct(PaymentChannel $paymentChannel, PaymentType $paymentType)
    {
        $isInstallmentOrMixed = in_array($paymentType, [PaymentType::INSTALLMENT(), PaymentType::MIXED()]);
        $channelForInstallmentOrMixed = PaymentChannel::BCA_KLIKPAY();

        if ($isInstallmentOrMixed && $paymentChannel !== $channelForInstallmentOrMixed) {
            throw new IncompatiblePaymentMethodException();
        }

        $this->channel = $paymentChannel;
        $this->type = $paymentType;
    }

    public function toArray(): array
    {
        return [
            'payment_channel' => $this->channel->getValue(),
            'pay_type' => $this->type->getValue(),
        ];
    }
}
