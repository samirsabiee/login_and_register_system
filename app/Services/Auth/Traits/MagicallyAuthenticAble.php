<?php


namespace App\Services\Auth\Traits;


use App\Models\LoginToken;
use Str;

trait MagicallyAuthenticAble
{
    public function magicToken()
    {
        return $this->hasOne(LoginToken::class);
    }

    function createToken()
    {
        $this->magicToken()->delete();
        return $this->magicToken()->create([
            'token' => Str::random(50),
        ]);
    }
}
