<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\SendMagicLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginToken extends Model
{
    const TOKEN_EXPIRY = 120;
    use HasFactory;

    protected $fillable = ['token'];

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function send(array $options = [])
    {
        SendEmail::dispatch(new \App\Services\Providers\SendEmail($this->user, new SendMagicLink($this, $options)));
    }

    public function isExpired(): bool
    {
        return $this->created_at->diffInSeconds(now()) > self::TOKEN_EXPIRY;
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', now()->subSeconds(self::TOKEN_EXPIRY));
    }
}
