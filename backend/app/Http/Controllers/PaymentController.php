<?php

namespace App\Http\Controllers;


use App\MyApp\Payment\Request\ShowByIdPaymentRequest;
use App\MyApp\Payment\Services\PaymentService;


class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->middleware('auth:api');
        $this->paymentService=$paymentService;
    }

    public function index()
    {
        return $this->paymentService->getPayments();
    }

    public function show(ShowByIdPaymentRequest $request)
    {
       return $this->paymentService->getPaymentDetails($request->validated());
    }

}
