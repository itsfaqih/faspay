<?php

use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Requests\InquiryPaymentStatusRequest;

it('has proper request payload', function () {
    $request = new InquiryPaymentStatusRequest($this->user, Environment::DEVELOPMENT(), '9876530282172110', 'TRX-123');

    expect($request->getPayload())->toBe([
        'request' => 'Inquiry Status Payment',
        'trx_id' => '9876530282172110',
        'bill_no' => 'TRX-123',
        'merchant_id' => $this->user->merchantId,
        'signature' => $this->user->getSignature('TRX-123'),
    ]);
});
