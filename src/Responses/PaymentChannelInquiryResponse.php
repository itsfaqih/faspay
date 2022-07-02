<?php

namespace ItsFaqih\Faspay\Responses;

use ItsFaqih\Faspay\Contracts\Response;
use ItsFaqih\Faspay\Entities\PaymentChannel;

class PaymentChannelInquiryResponse extends Response
{
    public string $response;
    public string $merchantId;
    public string $merchant;
    public string $responseCode;
    public string $responseDesc;
    public array $paymentChannel;

    public function handle(): void
    {
        $objectResponse = json_decode($this->stringResponse);

        $this->response = $objectResponse->response;
        $this->merchantId = $objectResponse->merchant_id;
        $this->merchant = $objectResponse->merchant;
        $this->paymentChannel = array_map(function ($paymentChannel) {
            return new PaymentChannel($paymentChannel->pg_code, $paymentChannel->pg_name);
        }, $objectResponse->payment_channel);
        $this->responseCode = $objectResponse->response_code;
        $this->responseDesc = $objectResponse->response_desc;
    }
}
