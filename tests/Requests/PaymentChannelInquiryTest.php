<?php

use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Requests\PaymentChannelInquiryRequest;

it('has proper request payload', function () {
    $request = new PaymentChannelInquiryRequest($this->user, Environment::DEVELOPMENT());

    expect($request->getPayload())->toBe([
        'request' => 'Request List of Payment Gateway',
        'signature' => $this->user->getSignature(),
        'merchant_id' => $this->user->merchantId,
        'merchant' => $this->user->merchantName,
    ]);
});
