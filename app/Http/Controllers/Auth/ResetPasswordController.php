<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset')->with([
            'email' => $request->query('email'),
            'token' => $request->query('token'),
        ]);
    }

    public function reset(ResetPasswordRequest $request): RedirectResponse
    {
        $response = Password::broker()->reset($request->only(['email', 'password', 'password_confirmatiom', 'token']),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            });
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('auth.login')->with('passwordChanged', true);
        }
        return back()->with('cantChangePassword', true);
    }
}
