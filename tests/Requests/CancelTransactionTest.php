<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use ItsFaqih\Faspay\Responses\CancelTransactionResponse;

it('can do cancel transaction', function () {
    $mock = new MockHandler([
            new Response(200, [
                    'Content-Type' => 'application/json',
            ], json_encode([
                    'response' => 'Canceling Payment',
                                        'trx_id' => '9876530200004184',
                    'merchant_id' => $this->user->merchantId,
                    'merchant' => $this->user->merchantName,
                    'bill_no' => 'TRX-123',
                    'trx_status_code' => '3',
                                        'trx_status_desc' => 'Order Expired',
                    'payment_status_code' => '7',
                    'payment_status_desc' => 'Payment Expired',
                    'payment_cancel_date' => '',
                    'payment_cancel' => 'Barang habis',
                    'response_code' => '54',
                    'response_desc' => 'Transaksi Anda telah kedaluwarsa.',
            ])),
    ]);

    $handlerStack = HandlerStack::create($mock);

    $this->faspayClient->setGuzzleConfig(['handler' => $handlerStack]);

    $response = $this->faspayClient->cancelTransaction('9876530200004184', 'TRX-123', 'Barang habis');

    expect($response)
            ->toBeInstanceOf(CancelTransactionResponse::class);

    expect($response->response)
            ->toBe('Canceling Payment');

    expect($response->trxId)
            ->toBe('9876530200004184');

    expect($response->merchantId)
            ->toBe($this->user->merchantId);

    expect($response->merchant)
            ->toBe($this->user->merchantName);

    expect($response->billNo)
            ->toBe('TRX-123');

    expect($response->trxStatusCode)
            ->toBe('3');

    expect($response->trxStatusDesc)
            ->toBe('Order Expired');

    expect($response->paymentStatusCode)
            ->toBe('7');

    expect($response->paymentStatusDesc)
            ->toBe('Payment Expired');

    expect($response->responseCode)
            ->toBe('54');

    expect($response->responseDesc)
            ->toBe('Transaksi Anda telah kedaluwarsa.');
});
