<?php

namespace ItsFaqih\Faspay\Requests;

use ItsFaqih\Faspay\Contracts\Request;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Responses\InquiryPaymentStatusResponse;

class InquiryPaymentStatusRequest extends Request
{
    private string $request = 'Inquiry Status Payment';
    private string $trxId;
    private string $billNo;

    public function __construct(User $user, Environment $environment, string $trxId, string $billNo)
    {
        parent::__construct($user, $environment);

        $this->trxId = $trxId;
        $this->billNo = $billNo;
    }

    public function getPayload(): array
    {
        return array_merge([
            'request' => $this->request,
            'trx_id' => $this->trxId,
            'bill_no' => $this->billNo,
            'merchant_id' => $this->user->merchantId,
            'signature' => $this->user->getSignature($this->billNo),
        ]);
    }

    public function handle(): InquiryPaymentStatusResponse
    {
        $response = $this->httpClient->post('/cvr/100004/10', [
            'json' => $this->getPayload(),
        ]);

        return new InquiryPaymentStatusResponse($response->getBody()->getContents());
    }
}
