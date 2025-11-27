<?php

namespace App\Http\Controllers\api\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class StripeController extends Controller
{
    public function success(Request $request)
    {
        DB::beginTransaction();
        try {
            $session_id = $request->data['object']['id'];
            $payment = Payment::where('session_id', $session_id)->first();
            $payment->status = "payed";
            $payment->save();
            

            DB::commit();
            return response()->json(['message' => 'Payment successful']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return ResponseFormatter::error('an error has been occured');
        }
    }

    public function cancel()
    {
        return response()->json(['message' => 'Payment cancelled']);
    }
}
