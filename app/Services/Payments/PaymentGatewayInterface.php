<?php

namespace App\Services\Payments;

interface PaymentGatewayInterface
{
    public function processPayment(array $data);

    public function refundPayment(array $data);

    public function setDiscount(float $discount);
}
