<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;

class HomeController extends Controller
{
    private $token = 'xnd_development_zJ7geXthOPJOioCRfE5mQ9FmzD4F6cVI8tkXI24HeWjzHU8UQ4Bf4WssV9AmSPB';
    public function welcome()
    {
        Xendit::setApiKey('xnd_development_zJ7geXthOPJOioCRfE5mQ9FmzD4F6cVI8tkXI24HeWjzHU8UQ4Bf4WssV9AmSPB');
        $getPaymentChannels = \Xendit\PaymentChannels::list();
        return view('welcome', compact('getPaymentChannels'));
    }

    public function balance()
    {
        Xendit::setApiKey('xnd_development_zJ7geXthOPJOioCRfE5mQ9FmzD4F6cVI8tkXI24HeWjzHU8UQ4Bf4WssV9AmSPB');
        $getBalance
            = \Xendit\VirtualAccounts::getVABanks();
        dd($getBalance);
    }
}
