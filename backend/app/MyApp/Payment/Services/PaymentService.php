<?php

namespace App\MyApp\Payment\Services;

use App\MyApp\Payment\Repositories\PaymentRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getPayments(): JsonResponse
    {
        try {
            $allPayments = $this->paymentRepository->getAll();
            return Response::build($allPayments, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with PaymentService.getPayments(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function getPaymentDetails($data): JsonResponse
    {
        try {
            $paymentDetails = $this->paymentRepository->showPayment($data['id']);
            return Response::build($paymentDetails, 200,__('msg/success.show'));
        } catch (\Exception $e) {
            Log::error("There was problem with PaymentService.getPaymentDetails(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.show'));
        }

    }
}
