<?php

namespace ItsFaqih\Faspay\Responses;

use ItsFaqih\Faspay\Contracts\Response;

class CancelTransactionResponse extends Response
{
    public string $response;
    public string $trxId;
    public string $merchantId;
    public string $merchant;
    public string $billNo;
    public string $trxStatusCode;
    public string $trxStatusDesc;
    public string $paymentStatusCode;
    public string $paymentStatusDesc;
    public string $paymentCancelDate;
    public string $paymentCancel;
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
        $this->trxStatusCode = $objectResponse->trx_status_code;
        $this->trxStatusDesc = $objectResponse->trx_status_desc;
        $this->paymentStatusCode = $objectResponse->payment_status_code;
        $this->paymentStatusDesc = $objectResponse->payment_status_desc;
        $this->paymentCancelDate = $objectResponse->payment_cancel_date;
        $this->paymentCancel = $objectResponse->payment_cancel;
        $this->responseCode = $objectResponse->response_code;
        $this->responseDesc = $objectResponse->response_desc;
    }
}
