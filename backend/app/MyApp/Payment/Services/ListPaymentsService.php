<?php

declare(strict_types=1);

namespace App\MyApp\Payment\Services;

use App\MyApp\Payment\Repositories\PaymentRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ListPaymentsService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function execute(): JsonResponse
    {
        try {
            $allPayments = $this->paymentRepository->getAll();
            return Response::build($allPayments, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ListPaymentsService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
