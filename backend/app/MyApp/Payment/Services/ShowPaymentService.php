<?php

declare(strict_types=1);

namespace App\MyApp\Payment\Services;

use App\MyApp\Payment\Repositories\PaymentRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ShowPaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function execute($data): JsonResponse
    {
        try {
            $paymentDetails = $this->paymentRepository->showPayment($data['id']);
            return Response::build($paymentDetails, 200, 'msg/success.show');
        } catch (\Exception $e) {
            Log::error("There was problem with ShowPaymentService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.show');
        }
    }
}
