<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payments\PaymentGatewayInterface;
use App\Services\Payments\PayPalGateway;

// or StripeGateway

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the interface to a specific implementation
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            // Use PayPalGateway or StripeGateway here
            return new PayPalGateway(); // Change this to StripeGateway for Stripe
        });
    }
}
