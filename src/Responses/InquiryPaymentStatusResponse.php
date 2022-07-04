<?php

namespace ItsFaqih\Faspay\Responses;

use ItsFaqih\Faspay\Contracts\Response;

class InquiryPaymentStatusResponse extends Response
{
    public string $response;
    public string $trxId;
    public string $merchantId;
    public string $merchant;
    public string $billNo;
    public string $paymentReff;
    public string $paymentDate;
    public string $paymentStatusCode;
    public string $paymentStatusDesc;
    public string $responseCode;
    public string $responseDesc;

    public function handle(): void
    {
        $objectResponse = json_decode($this->stringResponse);

        $this->response = $objectResponse->response;
        $this->trxId = $objectResponse->trx_id;
        $this->merchantId = $objectResponse->merchant_id;
        $this->merchant = $objectResponse->merchant;
        $this->billNo = $objectResponse->bill_no;
        $this->paymentReff = $objectResponse->payment_reff;
        $this->paymentDate = $objectResponse->payment_date;
        $this->paymentStatusCode = $objectResponse->payment_status_code;
        $this->paymentStatusDesc = $objectResponse->payment_status_desc;
        $this->responseCode = $objectResponse->response_code;
        $this->responseDesc = $objectResponse->response_desc;
    }
}
