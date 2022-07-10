<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use ItsFaqih\Faspay\Responses\InquiryPaymentStatusResponse;

it('can do inquiry payment status', function () {
    $mock = new MockHandler([
            new Response(200, [
                    'Content-Type' => 'application/json',
            ], json_encode([
                    'response' => 'Pengecekan Status Pembayaran',
                                        'trx_id' => '9876530200004184',
                    'merchant_id' => $this->user->merchantId,
                    'merchant' => $this->user->merchantName,
                    'bill_no' => 'TRX-123',
                    'payment_reff' => '456',
                    'payment_date' => '2016-07-22 14:59:30',
                    'payment_status_code' => '2',
                    'payment_status_desc' => 'Payment Sukses',
                    'response_code' => '00',
                    'response_desc' => 'Sukses',
            ])),
    ]);

    $handlerStack = HandlerStack::create($mock);

    $this->faspayClient->setGuzzleConfig(['handler' => $handlerStack]);

    $response = $this->faspayClient->inquiryPaymentStatus('9876530200004184', 'TRX-123');

    expect($response)
            ->toBeInstanceOf(InquiryPaymentStatusResponse::class);

    expect($response->response)
            ->toBe('Pengecekan Status Pembayaran');

    expect($response->trxId)
            ->toBe('9876530200004184');

    expect($response->merchantId)
            ->toBe($this->user->merchantId);

    expect($response->merchant)
            ->toBe($this->user->merchantName);

    expect($response->billNo)
            ->toBe('TRX-123');

    expect($response->paymentReff)
            ->toBe('456');

    expect($response->paymentDate)
            ->toBe('2016-07-22 14:59:30');

    expect($response->paymentStatusCode)
            ->toBe('2');

    expect($response->paymentStatusDesc)
            ->toBe('Payment Sukses');

    expect($response->responseCode)
            ->toBe('00');

    expect($response->responseDesc)
            ->toBe('Sukses');
});
