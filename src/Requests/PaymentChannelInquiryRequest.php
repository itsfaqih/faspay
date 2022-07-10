<?php

namespace ItsFaqih\Faspay\Requests;

use ItsFaqih\Faspay\Contracts\Request;
use ItsFaqih\Faspay\Responses\PaymentChannelInquiryResponse;

class PaymentChannelInquiryRequest extends Request
{
    private string $request = 'Request List of Payment Gateway';

    public function getPayload(): array
    {
        return array_merge([
            'request' => $this->request,
            'signature' => $this->user->getSignature(),
        ], $this->user->getMerchantArray());
    }

    public function handle(): PaymentChannelInquiryResponse
    {
        $response = $this->httpClient->post('/cvr/100001/10', [
            'json' => $this->getPayload(),
        ]);

        return new PaymentChannelInquiryResponse($response->getBody()->getContents());
    }
}
