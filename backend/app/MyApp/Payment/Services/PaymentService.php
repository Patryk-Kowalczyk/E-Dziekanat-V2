<?php

namespace App\MyApp\Payment\Services;

use App\MyApp\Payment\Repositories\PaymentRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class PaymentService
{

    protected $fractal;
    protected $tranformsUtil;
    protected $paymentRepository;


    public function __construct(PaymentRepository $paymentRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->paymentRepository=$paymentRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getPayments(): JsonResponse
    {
        $allPayments=$this->paymentRepository->getAll();
        return Response::build($allPayments,200);
    }

    public function getPaymentDetails($data): JsonResponse
    {
        $paymentDetails=$this->paymentRepository->showPayment($data['id']);
        return Response::build($paymentDetails,200);
    }



}
