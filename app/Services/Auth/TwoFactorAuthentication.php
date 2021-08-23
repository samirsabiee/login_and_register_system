<?php


namespace App\Services\Auth;


use App\Models\TwoFactor;
use App\Models\User;
use Request;

class TwoFactorAuthentication
{
    protected $request;

    /**
     * TwoFactorAuthentication constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestCode(User $user)
    {
        $code = TwoFactor::generateCodeFor($user);
        dd($code);
    }
}
