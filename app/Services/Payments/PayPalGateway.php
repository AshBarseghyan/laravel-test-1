<?php

namespace App\Services\Payments;

class PayPalGateway implements PaymentGatewayInterface
{
    public function processPayment(array $data)
    {
        // Process payment using PayPal
        return 'Payment processed using PayPal';
    }

    public function refundPayment(array $data)
    {
        // Process refund using PayPal
        return 'Refund processed using PayPal';
    }

    public function setDiscount(float $discount)
    {
        // Set discount for payment using PayPal
        return 'Discount set using PayPal';
    }
}
