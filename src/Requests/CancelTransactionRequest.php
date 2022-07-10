<?php

namespace ItsFaqih\Faspay\Requests;

use ItsFaqih\Faspay\Contracts\Request;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Responses\CancelTransactionResponse;

class CancelTransactionRequest extends Request
{
    private string $request = 'Inquiry Status Payment';
    private string $trxId;
    private string $billNo;
    private string $reason;

    public function __construct(User $user, Environment $environment, string $trxId, string $billNo, string $reason)
    {
        parent::__construct($user, $environment);

        $this->trxId = $trxId;
        $this->billNo = $billNo;
        $this->reason = $reason;
    }

    public function getPayload(): array
    {
        return array_merge([
            'request' => $this->request,
            'trx_id' => $this->trxId,
            'bill_no' => $this->billNo,
            'payment_cancel' => $this->reason,
            'signature' => $this->user->getSignature($this->billNo),
        ], $this->user->getMerchantArray());
    }

    public function handle(): CancelTransactionResponse
    {
        $response = $this->httpClient->post('/cvr/100005/10', [
            'json' => $this->getPayload(),
        ]);

        return new CancelTransactionResponse($response->getBody()->getContents());
    }
}
