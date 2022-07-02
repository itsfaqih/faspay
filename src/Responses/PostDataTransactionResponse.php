<?php

namespace ItsFaqih\Faspay\Responses;

use ItsFaqih\Faspay\Contracts\Response;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Enums\PaymentType;

class PostDataTransactionResponse extends Response
{
    public string $message;
    public string $trxId;
    public string $merchantId;
    public string $merchant;
    public string $billNo;
    public string $responseCode;
    public string $responseDesc;
    public string $redirectUrl;
    public array $billItems;

    public function handle(): void
    {
        $objectResponse = json_decode($this->stringResponse);

        $this->response = $objectResponse->response;
        $this->trxId = $objectResponse->trx_id;
        $this->merchantId = $objectResponse->merchant_id;
        $this->merchant = $objectResponse->merchant;
        $this->billNo = $objectResponse->bill_no;
        $this->billItems = array_map(function ($billItem) {
            $tenor = empty($billItem->tenor) ? null : $billItem->tenor;
            $merchantId = empty($billItem->merchant_id) ? null : $billItem->merchant_id;
            $paymentType = empty($billItem->payment_type) ? null : PaymentType::from($billItem->payment_type);

            return new BillItem($billItem->product, $billItem->qty, $billItem->amount, $paymentType, $tenor, $merchantId);
        }, $objectResponse->bill_items);
        $this->responseCode = $objectResponse->response_code;
        $this->responseDesc = $objectResponse->response_desc;
        $this->redirectUrl = $objectResponse->redirect_url;
    }
}
