<?php

namespace ItsFaqih\Faspay\Requests;

use ItsFaqih\Faspay\Contracts\Request;
use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\BillItem;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Responses\PostDataTransactionResponse;

class PostDataTransactionRequest extends Request
{
    private string $request = 'Post Data Transaction';
    private Bill $bill;
    private Payment $payment;
    private Customer $customer;
    private array $items;

    public function __construct(User $user, Environment $environment, Bill $bill, Payment $payment, Customer $customer, array $items)
    {
        parent::__construct($user, $environment);

        $this->bill = $bill;
        $this->payment = $payment;
        $this->customer = $customer;
        $this->items = $items;
    }

    public function handle(): PostDataTransactionResponse
    {
        $response = $this->httpClient->post('/cvr/300011/10', [
            'json' => array_merge(
                [
                    'request' => $this->request,
                    'item' => array_map(fn (BillItem $item) => $item->toArray(), $this->items),
                    'terminal' => '10',
                    'signature' => $this->user->getSignature($this->bill->number),
                ],
                $this->user->getMerchantArray(),
                $this->bill->toArray(),
                $this->payment->toArray(),
                $this->customer->toArray()
            ),
        ]);

        return new PostDataTransactionResponse($response->getBody()->getContents());
    }
}
