<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\RestPasswordEmail;
use App\Mail\VerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'provider',
        'provider_id',
        'avatar',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        SendEmail::dispatch(new \App\Services\Providers\SendEmail($this, new VerificationEmail($this)));
    }

    public function sendPasswordResetNotification($token)
    {
        SendEmail::dispatch(new \App\Services\Providers\SendEmail($this, new RestPasswordEmail($this, $token)));
    }
}
