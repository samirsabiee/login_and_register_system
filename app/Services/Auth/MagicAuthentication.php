<?php


namespace App\Services\Auth;


use App\Models\LoginToken;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MagicAuthentication
{
    public const INVALID_TOKEN = 'invalid.token';
    public const AUTHENTICATED = 'authenticated';
    private Request $request;

    /**
     * MagicAuthentication constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestLink()
    {
        $user = $this->getUser();
        $user->createToken()->send([
            'remember' => $this->request->has('remember')
        ]);
    }

    public function getUser()
    {
        return User::where('email', $this->request->email)->firstOrfail();
    }

    public function authenticate(LoginToken $token): string
    {
        $token->delete();
        if ($token->isExpired()) {
            return self::INVALID_TOKEN;
        }

        Auth::login($token->user, $this->request->query('remember'));

        return self::AUTHENTICATED;
    }


}
