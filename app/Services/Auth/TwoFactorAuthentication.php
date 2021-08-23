<?php


namespace App\Services\Auth;

use App\Models\TwoFactor;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TwoFactorAuthentication
{
    const CODE_SENT = 'code.sent';
    const CODE_INVALID = 'code.invalid';
    const ACTIVATED = 'code.activated';
    const AUTHENTICATED = 'code.authenticated';
    protected Request $request;
    protected $code;

    /**
     * TwoFactorAuthentication constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestCode(User $user): string
    {
        $code = TwoFactor::generateCodeFor($user);
        $this->setSession($code);
        $code->send();
        return self::CODE_SENT;
    }

    public function resent(): string
    {
        return $this->requestCode($this->getUser());
    }

    public function activate(): string
    {
        if (!$this->isValidateCode()) {
            return self::CODE_INVALID;
        }
        $this->getToken()->delete();
        $this->getUser()->activeTwoFactor();
        $this->forgetSession();
        return self::ACTIVATED;
    }

    public function login(): string
    {
        if (!$this->isValidateCode()) {
            return self::CODE_INVALID;
        }
        $this->getToken()->delete();
        Auth::login($this->getUser(), session('remember'));
        $this->forgetSession();
        return self::AUTHENTICATED;
    }

    public function deactivate(User $user)
    {
        $user->deactivateTwoFactor();
    }

    public function isValidateCode(): bool
    {
        return !$this->getToken()->isExpired() && $this->getToken()->isEqualWith($this->request->code);
    }

    public function setSession($code)
    {
        session([
            'code_id' => $code->id,
            'user_id' => $code->user->id,
            'remember' => $this->request->remember
        ]);
    }

    public function getToken()
    {
        return $this->code ?? $this->code = TwoFactor::findOrFail(session('code_id'));
    }

    public function getUser()
    {
        return User::find(session('user_id'));
    }

    public function forgetSession()
    {
        session()->forget(['code_id', 'user_id']);
    }
}
