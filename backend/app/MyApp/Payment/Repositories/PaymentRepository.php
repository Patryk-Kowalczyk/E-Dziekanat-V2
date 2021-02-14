<?php

namespace App\MyApp\Payment\Repositories;

use App\Models\Payment;
use App\Models\Paymentsdetails;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    protected $payment;
    protected $paymentsdetails;

    public function __construct(Payment $payment, Paymentsdetails $paymentsdetails)
    {
        $this->payment = $payment;
        $this->paymentsdetails = $paymentsdetails;
    }

    public function getAll(): Collection
    {
        return $this->payment->where('user_id', Auth::id())->get()->makeHidden('user_id');
    }

    public function showPayment($id): object
    {
        return $this->paymentsdetails->where('payment_id', $id)->get()->makeHidden(['id', 'payment_id']);
    }
}
