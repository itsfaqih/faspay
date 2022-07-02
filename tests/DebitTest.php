<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use ItsFaqih\Faspay\Client as FaspayClient;
use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Entities\PaymentChannel as PaymentChannelEntity;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Enums\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentType;
use ItsFaqih\Faspay\Responses\PaymentChannelInquiryResponse;
use ItsFaqih\Faspay\Responses\PostDataTransactionResponse;

beforeEach(function () {
    $this->user = new User(
        'bot98765',
        'p@ssw0rd',
        '98765',
        'FASPAY'
    );

    $this->faspayClient = new FaspayClient(
        $this->user,
        Environment::DEVELOPMENT()
    );
});

it('can do payment channel inquiry', function () {
    $mock = new MockHandler([
        new Response(200, [
            'Content-Type' => 'application/json',
        ], json_encode([
            'response' => 'Request List of Payment Gateway',
            'merchant_id' => $this->user->merchantId,
            'merchant' => $this->user->merchantName,
            'payment_channel' => [
                [
                    'pg_code' => '302',
                    'pg_name' => 'LinkAja',
                ],
            ],
            'response_code' => '00',
            'response_desc' => 'Sukses',
        ])),
    ]);

    $handlerStack = HandlerStack::create($mock);

    $this->faspayClient->setGuzzleConfig(['handler' => $handlerStack]);

    $response = $this->faspayClient->paymentChannelInquiry();

    expect($response)
        ->toBeInstanceOf(PaymentChannelInquiryResponse::class);

    expect($response->response)
        ->toBe('Request List of Payment Gateway');

    expect($response->merchantId)
        ->toBe($this->user->merchantId);

    expect($response->merchant)
        ->toBe($this->user->merchantName);

    expect($response->paymentChannel)
        ->toBeArray();

    expect($response->paymentChannel[0])
        ->toBeInstanceOf(PaymentChannelEntity::class);

    expect($response->paymentChannel[0]->code)
        ->toBe('302');

    expect($response->paymentChannel[0]->name)
        ->toBe('LinkAja');

    expect($response->paymentChannel[0]->enum)
        ->toBeInstanceOf(PaymentChannel::class);

    expect($response->responseCode)
        ->toBe('00');

    expect($response->responseDesc)
        ->toBe('Sukses');
});

it('can do post data transaction with full settlement as payment type', function ($paymentChannel) {
    $bill = new Bill('TRX-123', new \DateTime(), (new \DateTime())->modify('+1 day'), 'Red Shoes with special price', '250000');
    $payment = new Payment($paymentChannel, PaymentType::FULL_SETTLEMENT());
    $customer = new Customer('001', 'John Smith', '08123456789', 'john.smith@example.com');
    $item = new BillItem('Red Shoes', 1, '250000');

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
                $item->toArray(),
            ],
            'response_code' => '00',
            'response_desc' => 'Sukses',
            'redirect_url' => 'https://example.com',
        ])),
    ]);

    $handlerStack = HandlerStack::create($mock);

    $this->faspayClient->setGuzzleConfig(['handler' => $handlerStack]);

    $response = $this->faspayClient->postDataTransaction($bill, $payment, $customer, [$item]);

    expect($response)
        ->toBeInstanceOf(PostDataTransactionResponse::class);

    expect($response->response)
        ->toBe('Transmisi Info Detil Pembelian');

    expect($response->merchantId)
        ->toBe($this->user->merchantId);

    expect($response->merchant)
        ->toBe($this->user->merchantName);

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
})
    ->with(PaymentChannel::values());
