<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Contracts\Entity;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Exceptions\Payment\IncompatiblePaymentMethodException;

class Payment extends Entity
{
    public PaymentChannel $channel;
    public PaymentType $type;

    public static array $requiredKeys = [
        'channel',
        'type',
    ];

    public function __construct(PaymentChannel $paymentChannel, PaymentType $paymentType)
    {
        $isInstallmentOrMixed = in_array($paymentType, [PaymentType::INSTALLMENT(), PaymentType::MIXED()]);
        $channelForInstallmentOrMixed = PaymentChannel::BCA_KLIKPAY();

        if ($isInstallmentOrMixed && ! $paymentChannel->equals($channelForInstallmentOrMixed)) {
            throw new IncompatiblePaymentMethodException();
        }

        $this->channel = $paymentChannel;
        $this->type = $paymentType;
    }

    public static function fromArray(array $data): Payment
    {
        self::validateArrayData($data);

        return new static(
            $data['channel'],
            $data['type'],
        );
    }

    public function toArray(): array
    {
        return [
            'payment_channel' => $this->channel->getValue(),
            'pay_type' => $this->type->getValue(),
        ];
    }
}
