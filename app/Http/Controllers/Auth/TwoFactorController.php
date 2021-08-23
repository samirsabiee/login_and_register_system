<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\TwoFactorAuthentication;

class TwoFactorController extends Controller
{

    /**
     * TwoFactorController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showToggleForm()
    {
        return view('auth.two-factor.toggle');
    }

    public function activate(TwoFactorAuthentication $twoFactorAuthentication)
    {
        $twoFactorAuthentication->requestCode(auth()->user());
        //dd($response);
    }
}
