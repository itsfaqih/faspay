<?php

namespace ItsFaqih\Faspay\Entities;

use ItsFaqih\Faspay\Exceptions\Bill\InvalidCurrencyException;
use ItsFaqih\Faspay\Exceptions\Bill\InvalidExpiredDateException;
use ItsFaqih\Faspay\Exceptions\General\NotNumericException;

class Bill
{
    public $number;
    public $reference;
    public $date;
    public $expired;
    public $description;
    public $currency;
    public $gross;
    public $miscFee;
    public $total;

    public function __construct(string $number, \DateTime $date, \DateTime $expired, string $description, string $total, ?string $gross = null, ?string $miscFee = null, ?string $reference = null, string $currency = 'IDR')
    {
        if ($expired <= $date) {
            throw new InvalidExpiredDateException();
        }

        if (! is_numeric($total)) {
            throw new NotNumericException('Total');
        }

        if (! empty($gross) && ! is_numeric($gross)) {
            throw new NotNumericException('Gross');
        }

        if (! empty($miscFee) && ! is_numeric($miscFee)) {
            throw new NotNumericException('Miscellaneous Fee');
        }

        if ($currency !== 'IDR') {
            throw new InvalidCurrencyException();
        }

        $this->number = $number;
        $this->reference = $reference;
        $this->date = $date;
        $this->expired = $expired;
        $this->description = $description;
        $this->currency = $currency;
        $this->gross = $gross;
        $this->miscFee = $miscFee;
        $this->total = $total;
    }

    public function setNumber(string $number): string
    {
        return $this->number = $number;
    }

    public function setReference(string $reference): string
    {
        return $this->reference = $reference;
    }

    public function setDate(\DateTime $date): \DateTime
    {
        if (! empty($this->expired) && $date >= $this->expired) {
            throw new InvalidExpiredDateException();
        }

        return $this->date = $date;
    }

    public function setExpired(\DateTime $expired): \DateTime
    {
        if (! empty($this->date) && $expired <= $this->date) {
            throw new InvalidExpiredDateException();
        }

        return $this->expired = $expired;
    }

    public function setDescription(string $description): string
    {
        return $this->description = $description;
    }

    public function setCurrency(string $currency): string
    {
        if ($currency !== 'IDR') {
            throw new InvalidCurrencyException();
        }

        return $this->currency = $currency;
    }

    public function setGross(string $gross): string
    {
        if (! is_numeric($gross)) {
            throw new NotNumericException('Gross');
        }

        return $this->gross = $gross;
    }

    public function setMiscFee(string $miscFee): string
    {
        if (! is_numeric($miscFee)) {
            throw new NotNumericException('Miscellaneous Fee');
        }

        return $this->miscFee = $miscFee;
    }

    public function setTotal(string $total): string
    {
        if (! is_numeric($total)) {
            throw new NotNumericException('Total');
        }

        return $this->total = $total;
    }

    public function toArray(): array
    {
        return [
            'bill_no' => $this->number,
            'bill_reff' => $this->reference,
            'bill_date' => $this->date->format('Y-m-d H:i:s'),
            'bill_expired' => $this->expired->format('Y-m-d H:i:s'),
            'bill_desc' => $this->description,
            'bill_currency' => $this->currency,
            'bill_gross' => $this->gross,
            'bill_miscfee' => $this->miscFee,
            'bill_total' => $this->total,
        ];
    }
}
