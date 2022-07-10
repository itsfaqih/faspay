<?php

use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Requests\CancelTransactionRequest;

it('has proper request payload', function () {
    $request = new CancelTransactionRequest($this->user, Environment::DEVELOPMENT(), '9876530282172110', 'TRX-123', 'Wrong Order');

    expect($request->getPayload())->toBe([
        'request' => 'Inquiry Status Payment',
        'trx_id' => '9876530282172110',
        'bill_no' => 'TRX-123',
        'payment_cancel' => 'Wrong Order',
        'signature' => $this->user->getSignature('TRX-123'),
        'merchant_id' => $this->user->merchantId,
        'merchant' => $this->user->merchantName,
    ]);
});
