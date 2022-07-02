<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use ItsFaqih\Faspay\Entities\PaymentChannel;
use ItsFaqih\Faspay\Enums\PaymentChannel as PaymentChannelEnum;
use ItsFaqih\Faspay\Responses\PaymentChannelInquiryResponse;

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
            ->toBeInstanceOf(PaymentChannel::class);

    expect($response->paymentChannel[0]->code)
            ->toBe('302');

    expect($response->paymentChannel[0]->name)
            ->toBe('LinkAja');

    expect($response->paymentChannel[0]->enum)
            ->toBeInstanceOf(PaymentChannelEnum::class);

    expect($response->responseCode)
            ->toBe('00');

    expect($response->responseDesc)
            ->toBe('Sukses');
});
