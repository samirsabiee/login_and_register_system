<?php


namespace App\Services\Auth;


use App\Jobs\SendSms;
use App\Models\TwoFactor;
use App\Models\User;
use Request;

class TwoFactorAuthentication
{
    const CODE_SENT = 'code.sent';
    protected $request;

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
        $code->send();
        return self::CODE_SENT;
    }
}
