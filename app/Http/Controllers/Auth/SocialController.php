<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialController extends Controller
{
    public function redirectToProvider($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback($driver): \Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver($driver)->user();
        Auth::login($this->findOrCreateUser($driver, $user));
        return redirect()->intended();
    }

    protected function findOrCreateUser($driver, $user)
    {
        $providerUser = User::where([
            'email' => $user->getEmail(),
        ])->first();

        if (!is_null($providerUser)) return $providerUser;

        return User::create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'provider' => $driver,
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now(),
        ]);
    }

}
