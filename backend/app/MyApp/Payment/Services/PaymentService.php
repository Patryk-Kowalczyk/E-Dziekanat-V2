<?php

namespace App\MyApp\Payment\Services;

use App\MyApp\Payment\Repositories\PaymentRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getPayments(): JsonResponse
    {
        $allPayments = $this->paymentRepository->getAll();
        return Response::build($allPayments, 200);
    }

    public function getPaymentDetails($data): JsonResponse
    {
        $paymentDetails = $this->paymentRepository->showPayment($data['id']);
        return Response::build($paymentDetails, 200);
    }
}
