<?php

namespace App\Services\Payments;


class StripeGateway implements PaymentGatewayInterface
{
    public function processPayment(array $data)
    {
        // Process payment using Stripe
        return 'Payment processed using Stripe';
    }

    public function refundPayment(array $data)
    {
        // Process refund using Stripe
        return 'Refund processed using Stripe';
    }

    public function setDiscount(float $discount)
    {
        // Set discount for payment using Stripe
        return 'Discount set using Stripe';
    }
}
