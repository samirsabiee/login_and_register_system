<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;
    public function showForgetForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLink(ForgetPasswordRequest $request): RedirectResponse
    {
        $response = Password::broker()->sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('resetLinkSent', true);
        }
        return back()->with('resetLinkSendFailed', true);
    }

}

