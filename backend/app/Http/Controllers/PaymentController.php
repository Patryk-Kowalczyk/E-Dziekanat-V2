<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Paymentsdetails;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        $payments = Payment::where('user_id', Auth::id())->get()->makeHidden('user_id');

        return response()->json(['payments' => $payments]);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $idPayment=$request['payment_id'];
        $paymentDetails = Paymentsdetails::where('payment_id', $idPayment)->get()->makeHidden(['id','payment_id']);

        return response()->json(['payments' => $paymentDetails]);

    }

}
