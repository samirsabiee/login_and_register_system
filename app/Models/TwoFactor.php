<?php

namespace App\Models;

use App\Jobs\SendSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactor extends Model
{
    use HasFactory;

    protected $table = 'two_factor';
    protected $fillable = ['user_id', 'code'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function generateCodeFor(User $user)
    {
        $user->code()->delete();
        return static::create([
            'user_id' => $user->id,
            'code' => mt_rand(1000, 9999)
        ]);
    }

    public function getCodeForSendAttribute()
    {
        return __('public.CodeForSend', ['code' => $this->code]);
    }

    public function send()
    {
        SendSms::dispatch(new \App\Services\Providers\SendSms($this->user, $this->code_for_send));
    }
}
