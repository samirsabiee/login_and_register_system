<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\MagicLoginRequest;
use App\Models\LoginToken;
use App\Services\Auth\MagicAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MagicController extends Controller
{
    private MagicAuthentication $auth;

    /**
     * MagicController constructor.
     * @param MagicAuthentication $auth
     */
    public function __construct(MagicAuthentication $auth)
    {
        $this->auth = $auth;
    }

    public function showMagicForm()
    {
        return view('auth.magic-login');
    }

    public function sendToken(MagicLoginRequest $request): RedirectResponse
    {
        $this->auth->requestLink();
        return back()->with('magicLinkSent', true);
    }

    public function login(LoginToken $token)
    {
        return $this->auth->authenticate($token) === $this->auth::AUTHENTICATED ?
            redirect()->route('home') :
            redirect()->route('auth.magic.login.form')->with('invalidToken', true);
    }
}
