<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Services\Payments\PaymentService;
use App\Services\Payments\PaymentGatewayInterface;
use Mockery;

class PaymentServiceTest extends TestCase
{
    protected $paymentGatewayMock;
    protected $paymentService;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock for PaymentGatewayInterface
        $this->paymentGatewayMock = Mockery::mock(PaymentGatewayInterface::class);

        // Bind the mock to the PaymentService
        $this->paymentService = new PaymentService($this->paymentGatewayMock);
    }

    public function testProcessPayment()
    {
        $amount = 100.0;
        $currency = 'USD';

        // Define the expected behavior of the mock
        $this->paymentGatewayMock->shouldReceive('processPayment')
            ->with([
                'amount' => $amount,
                'currency' => $currency,
            ])
            ->andReturn(true);

        // Call the method and assert the result
        $result = $this->paymentService->processPayment($amount, $currency);
        $this->assertTrue($result);
    }

    public function testRefundPayment()
    {
        $amount = 50.0;
        $currency = 'USD';

        // Define the expected behavior of the mock
        $this->paymentGatewayMock->shouldReceive('refundPayment')
            ->with([
                'amount' => $amount,
                'currency' => $currency,
            ])
            ->andReturn(true);

        // Call the method and assert the result
        $result = $this->paymentService->refundPayment($amount, $currency);
        $this->assertTrue($result);
    }

    public function testSetDiscount()
    {
        $discount = 15.0;

        // Define the expected behavior of the mock
        $this->paymentGatewayMock->shouldReceive('setDiscount')
            ->with($discount)
            ->once(); // Assert that the method is called exactly once

        // Call the method
        $this->paymentService->setDiscount($discount);

        // Verify that the method was called with the correct parameters
        $this->paymentGatewayMock->shouldHaveReceived('setDiscount')
            ->with($discount)
            ->once();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

