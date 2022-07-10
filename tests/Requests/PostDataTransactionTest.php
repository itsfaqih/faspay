<?php

use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Requests\PostDataTransactionRequest;

it('has proper request payload', function () {
    $bill = new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('+1 day'), 'Red Shoes with special price', '250000');
    $payment = new Payment(PaymentChannel::LINKAJA(), PaymentType::FULL_SETTLEMENT());
    $customer = new Customer('001', 'John Smith', '08123456789', 'john.smith@example.com');
    $item = new BillItem('Red Shoes', 1, '250000');

    $request = new PostDataTransactionRequest($this->user, Environment::DEVELOPMENT(), $bill, $payment, $customer, [$item]);

    expect($request->getPayload())->toBe([
        'request' => 'Post Data Transaction',
        'item' => [
            array_filter([
                'product' => $item->name,
                'qty' => $item->quantity,
                'amount' => $item->price,
                                'payment_plan' => $item->paymentType->getValue(),
                'tenor' => $item->tenor,
            ], function ($value) {
                return $value !== null;
            }),
        ],
        'terminal' => '10',
        'signature' => $this->user->getSignature($bill->number),
        'merchant_id' => $this->user->merchantId,
        'merchant' => $this->user->merchantName,
        'bill_no' => $bill->number,
        'bill_date' => $bill->date->format('Y-m-d H:i:s'),
        'bill_expired' => $bill->expired->format('Y-m-d H:i:s'),
        'bill_desc' => $bill->description,
        'bill_currency' => $bill->currency,
        'bill_total' => $bill->total,
        'payment_channel' => $payment->channel->getValue(),
        'pay_type' => $payment->type->getValue(),
        'cust_no' => $customer->number,
        'cust_name' => $customer->name,
        'msisdn' => $customer->phone,
        'email' => $customer->email,
    ]);
});
