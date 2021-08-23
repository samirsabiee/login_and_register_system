<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmTwoFactorCodeRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\TwoFactorAuthentication;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected TwoFactorAuthentication $twoFactorAuthentication;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TwoFactorAuthentication $twoFactorAuthentication)
    {
        $this->middleware('guest')->except('logout');
        $this->twoFactorAuthentication = $twoFactorAuthentication;
    }


    protected function logout(): RedirectResponse
    {
        session()->invalidate();
        Auth::logout();
        return redirect()->route('home');
    }

    protected function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    protected function login(LoginRequest $request): RedirectResponse
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }

        if (!$this->isValidCredentials($request)) {
            $this->incrementLoginAttempts($request);
            return $this->sendLoginFailedResponse();
        }
        $user = $this->getUser($request);
        if ($user->isTwoFactorActivate()) {
            $this->twoFactorAuthentication->requestCode($user);
            return $this->hasTwoFactorResponse();
        }

        Auth::login($user, $request->remember);
        return $this->sendLoginSuccessResponse();


        /* if ($this->attemptLogin($request)) {
             return $this->sendLoginSuccessResponse();
         }
         $this->incrementLoginAttempts($request);
         return $this->sendLoginFailedResponse();*/
    }

    protected function hasTwoFactorResponse(): RedirectResponse
    {
        return redirect()->route('auth.login.code.form');
    }

    protected function getUser($request)
    {
        return User::where('email', $request->email)->firstOrFail();
    }

    protected function isValidCredentials($request): bool
    {
        return Auth::validate($request->only('email', 'password'));
    }

    protected function sendLoginSuccessResponse(): RedirectResponse
    {
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendLoginFailedResponse(): RedirectResponse
    {
        return back()->with('wrongCredentials', true);
    }

    /*    protected function attemptLogin(LoginRequest $request): bool
        {
            return Auth::attempt($request->only(['email', 'password']), $request->filled('remember'));
        }*/

    protected function username(): string
    {
        return 'email';
    }

    public function showCodeForm()
    {
        return view('auth.two-factor.login-code');
    }

    public function confirmCode(ConfirmTwoFactorCodeRequest $request): RedirectResponse
    {
        $response = $this->twoFactorAuthentication->login();
        return $response === $this->twoFactorAuthentication::AUTHENTICATED ?
            redirect()->route('home') :
            back()->with('invalidCode', true);
    }
}
