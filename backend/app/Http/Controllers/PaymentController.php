<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\MyApp\Payment\Request\ShowByIdPaymentRequest;
use App\MyApp\Payment\Services\ListPaymentsService;
use App\MyApp\Payment\Services\ShowPaymentService;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    protected $listPaymentsService;
    protected $showPaymentService;

    public function __construct(ListPaymentsService $listPaymentsService,
                                ShowPaymentService $showPaymentService)
    {
        $this->middleware('auth:api');
        $this->listPaymentsService = $listPaymentsService;
        $this->showPaymentService = $showPaymentService;
    }

    public function index(): JsonResponse
    {
        return $this->listPaymentsService->execute();
    }

    public function show(ShowByIdPaymentRequest $request): JsonResponse
    {
        return $this->showPaymentService->execute($request->validated());
    }
}
