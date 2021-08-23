<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmTwoFactorCodeRequest;
use App\Services\Auth\TwoFactorAuthentication;
use Illuminate\Http\RedirectResponse;

class TwoFactorController extends Controller
{

    protected TwoFactorAuthentication $twoFactorAuthentication;

    /**
     * TwoFactorController constructor.
     */
    public function __construct(TwoFactorAuthentication $twoFactorAuthentication)
    {
        $this->twoFactorAuthentication = $twoFactorAuthentication;
        $this->middleware('auth');
    }

    public function showToggleForm()
    {
        return view('auth.two-factor.toggle');
    }

    public function activate(): RedirectResponse
    {
        $response = $this->twoFactorAuthentication->requestCode(auth()->user());
        return $response === $this->twoFactorAuthentication::CODE_SENT ?
            redirect()->route('auth.two.factor.code.form') :
            back()->with('cantSendCode', true);
    }

    public function showEnterCodeForm()
    {
        return view('auth.two-factor.enter-code');
    }

    public function confirmCode(ConfirmTwoFactorCodeRequest $request): RedirectResponse
    {
        $response = $this->twoFactorAuthentication->activate();
        return $response === $this->twoFactorAuthentication::ACTIVATED ?
            redirect()->route('home')->with('twoFactorActivated', true) :
            back()->with('invalidCode', true);
    }

    public function deactivate(): RedirectResponse
    {
        $this->twoFactorAuthentication->deactivate(auth()->user());
        return back()->with('twoFactorDeactivated', true);
    }
}
