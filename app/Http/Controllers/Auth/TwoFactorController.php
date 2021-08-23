<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TwoFactor;
use App\Services\Auth\TwoFactorAuthentication;
use Illuminate\Http\RedirectResponse;

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

    public function activate(TwoFactorAuthentication $twoFactorAuthentication): RedirectResponse
    {
        $response = $twoFactorAuthentication->requestCode(auth()->user());
        return $response === $twoFactorAuthentication::CODE_SENT ?
            redirect()->route('auth.two.factor.code.form') :
            back()->with('cantSendCode', true);
    }

    public function showEnterCodeForm()
    {
        return view('auth.two-factor.enter-code');
    }
}
