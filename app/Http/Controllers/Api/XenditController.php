<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

use Xendit\Xendit;
use Carbon\Carbon;

class XenditController extends Controller
{
    private $token = 'xnd_development_zJ7geXthOPJOioCRfE5mQ9FmzD4F6cVI8tkXI24HeWjzHU8UQ4Bf4WssV9AmSPB';

    public function getListVa()
    {
        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return response()->json([
            'data' => $getVABanks
        ])->setStatusCode(200);
    }

    public function createVa(Request $request)
    {
        Xendit::setApiKey($this->token);
        $external_id = 'va-' . time();
        $params = [
            'external_id' => $external_id,
            'bank_code' => $request->bank,
            'name' => $request->email,
            'expected_amount' => $request->price,
            'is_closed' => true,
            'expiration_date' => Carbon::now()->addDays(1)->toISOString(),
            'is_single_use' => true,
        ];



        $createVa = \Xendit\VirtualAccounts::create($params);

        Payment::create([
            'external_id' => $external_id,
            'payment_channel' => 'Virtual Account',
            'email' => $request->email,
            'price' => $request->price,
            'owner_id' => $createVa['owner_id'],
            'status' => 'UNPAID',

        ]);




        return response()->json([
            'data' => $createVa
        ])->setStatusCode(200);
    }

    public function callback(Request $request)
    {
        $external_id = $request->external_id;
        $status = $request->status;
        $payment = Payment::where('external_id', $external_id)->exists();
        if ($payment) {
            if ($status == NULL) {
                $update = Payment::where('external_id', $external_id)->update([
                    'status' => 1
                ]);
                if ($update > 0) {
                    return 'berhasil di update';
                }
                return 'gagal';
            }
        } else {
            return response()->json([
                'message' => 'Data tidak ada'
            ]);
        }
    }

    // public function callback(Request $request)
    // {
    //     $attributes = $request->all();

    //     $invoice = Invoice::with('balanceHistory.balance')
    //         ->where('invoice_id', $attributes['external_id'])
    //         ->first();

    //     $transaction = Transaction::where('reference', $attributes['external_id'])
    //         ->where('status', 'UNPAID')
    //         ->first();

    //     if ($invoice) {
    //         $invoice->status = $attributes['status'];
    //         if ($attributes['status'] == 'PAID') {
    //             $invoice->paid_at = new dateTime($attributes['paid_at']);
    //             $invoice->payment_method = $attributes['payment_channel'];
    //             $invoice->balanceHistory->balance()->increment('amount', $invoice->amount);
    //         }
    //         $invoice->save();
    //     }

    //     return Response::status('success')
    //         ->message('Callback accepted successfully')
    //         ->result();
    // }
}
