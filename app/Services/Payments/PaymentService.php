<?php

namespace App\Services\Payments;

class PaymentService
{
    protected $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function processPayment(float $amount, string $currency): bool
    {
        return $this->paymentGateway->processPayment([
            'amount' => $amount,
            'currency' => $currency,
        ]);
    }

    public function refundPayment(float $amount, string $currency): bool
    {
        return $this->paymentGateway->refundPayment([
            'amount' => $amount,
            'currency' => $currency,
        ]);
    }

    public function setDiscount(float $discount): void
    {
        $this->paymentGateway->setDiscount($discount);
    }
}
