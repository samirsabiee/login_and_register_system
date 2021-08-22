<?php

namespace App\Mail;

use App\Models\LoginToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMagicLink extends Mailable
{
    use Queueable, SerializesModels;

    private LoginToken $token;
    private array $options;

    /**
     * SendMagicLink constructor.
     * @param LoginToken $loginToken
     * @param array $options
     */
    public function __construct(LoginToken $loginToken, array $options)
    {
        $this->token = $loginToken;
        $this->options = $options;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SendMagicLink
    {
        return $this->markdown('email.magic-link')->with([
            'link' => $this->buildLink(),
        ]);
    }

    protected function buildLink(): string
    {
        return route('auth.magic.login', [
                'token' => $this->token->token
            ] + $this->options);
    }
}
