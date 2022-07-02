<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Responses\PostDataTransactionResponse;

beforeEach(function () {
    $this->bill = new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('+1 day'), 'Red Shoes with special price', '250000');
    $this->customer = new Customer('001', 'John Smith', '08123456789', 'john.smith@example.com');
    $this->item = new BillItem('Red Shoes', 1, '250000');

    $mock = new MockHandler([
        new Response(200, [
            'Content-Type' => 'application/json',
        ], json_encode([
            'response' => 'Transmisi Info Detil Pembelian',
            'trx_id' => '9876530200004184',
            'merchant_id' => $this->user->merchantId,
            'merchant' => $this->user->merchantName,
            'bill_no' => 'TRX-123',
            'bill_items' => [
                $this->item->toArray(),
            ],
            'response_code' => '00',
            'response_desc' => 'Sukses',
            'redirect_url' => 'https://example.com',
        ])),
    ]);

    $handlerStack = HandlerStack::create($mock);

    $this->faspayClient->setGuzzleConfig(['handler' => $handlerStack]);
});

it('can do post data transaction with full settlement as payment type', function ($paymentChannel) {
    $payment = new Payment($paymentChannel, PaymentType::FULL_SETTLEMENT());

    $response = $this->faspayClient->postDataTransaction($this->bill, $payment, $this->customer, [$this->item]);

    validatePostDataTransaction($response, $this->user);
})
    ->with(PaymentChannel::values());

it('can do post data transaction with installment as payment type', function () {
    $payment = new Payment(PaymentChannel::BCA_KLIKPAY(), PaymentType::INSTALLMENT());

    $response = $this->faspayClient->postDataTransaction($this->bill, $payment, $this->customer, [$this->item]);

    validatePostDataTransaction($response, $this->user);
});

it('can do post data transaction with mixed as payment type', function () {
    $payment = new Payment(PaymentChannel::BCA_KLIKPAY(), PaymentType::MIXED());

    $response = $this->faspayClient->postDataTransaction($this->bill, $payment, $this->customer, [$this->item]);

    validatePostDataTransaction($response, $this->user);
});

function validatePostDataTransaction($response, $user)
{
    expect($response)
        ->toBeInstanceOf(PostDataTransactionResponse::class);

    expect($response->response)
        ->toBe('Transmisi Info Detil Pembelian');

    expect($response->merchantId)
        ->toBe($user->merchantId);

    expect($response->merchant)
        ->toBe($user->merchantName);

    expect($response->billNo)
        ->toBe('TRX-123');

    expect($response->billItems)
        ->toBeArray();

    expect($response->billItems[0])
        ->toBeInstanceOf(BillItem::class);

    expect($response->billItems[0]->name)
        ->toBe('Red Shoes');

    expect($response->billItems[0]->quantity)
        ->toBe(1);

    expect($response->billItems[0]->price)
        ->toBe('250000');

    expect($response->billItems[0]->paymentType)
        ->toBeInstanceOf(PaymentType::class);

    expect($response->responseCode)
        ->toBe('00');

    expect($response->responseDesc)
        ->toBe('Sukses');

    expect($response->redirectUrl)
        ->toBe('https://example.com');
}
