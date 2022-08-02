<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    public function welcome()
    {
        Xendit::setApiKey('xnd_development_zJ7geXthOPJOioCRfE5mQ9FmzD4F6cVI8tkXI24HeWjzHU8UQ4Bf4WssV9AmSPB');
        $getPaymentChannels = \Xendit\PaymentChannels::list();
        $collection = collect($getPaymentChannels);
        return $collection ? json_decode($collection) : 'nnul';
    }
}
