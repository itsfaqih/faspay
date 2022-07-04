<?php

namespace ItsFaqih\Faspay;

use ItsFaqih\Faspay\Entities\Bill;
use ItsFaqih\Faspay\Entities\Customer;
use ItsFaqih\Faspay\Entities\Payment;
use ItsFaqih\Faspay\Entities\User;
use ItsFaqih\Faspay\Enums\Environment;
use ItsFaqih\Faspay\Requests\InquiryPaymentStatusRequest;
use ItsFaqih\Faspay\Requests\PaymentChannelInquiryRequest;
use ItsFaqih\Faspay\Requests\PostDataTransactionRequest;
use ItsFaqih\Faspay\Responses\InquiryPaymentStatusResponse;
use ItsFaqih\Faspay\Responses\PaymentChannelInquiryResponse;
use ItsFaqih\Faspay\Responses\PostDataTransactionResponse;

class Client
{
    private $user;
    private $environment;
    private $guzzleConfig;

    public function __construct(User $user, Environment $environment, array $guzzleConfig = [])
    {
        $this->user = $user;
        $this->environment = $environment;
        $this->guzzleConfig = $guzzleConfig;
    }

    public function setUser(User $user): User
    {
        return $this->user = $user;
    }

    public function setEnvironment(Environment $environment): Environment
    {
        return $this->environment = $environment;
    }

    public function setGuzzleConfig(array $guzzleConfig): array
    {
        return $this->guzzleConfig = $guzzleConfig;
    }

    public function paymentChannelInquiry(): PaymentChannelInquiryResponse
    {
        $request = new PaymentChannelInquiryRequest($this->user, $this->environment);

        $request->setConfig($this->guzzleConfig);

        return $request->handle();
    }

    public function postDataTransaction(Bill $bill, Payment $payment, Customer $customer, array $items): PostDataTransactionResponse
    {
        $request = new PostDataTransactionRequest($this->user, $this->environment, $bill, $payment, $customer, $items);

        $request->setConfig($this->guzzleConfig);

        return $request->handle();
    }

    public function inquiryPaymentStatus(string $trxId, string $billNo): InquiryPaymentStatusResponse
    {
        $request = new InquiryPaymentStatusRequest($this->user, $this->environment, $trxId, $billNo);

        $request->setConfig($this->guzzleConfig);

        return $request->handle();
    }
}
