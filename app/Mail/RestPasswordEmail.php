<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    private string $token;

    /**
     * RestPasswordEmail constructor.
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): RestPasswordEmail
    {
        return $this->markdown('email.reset-password')->with([
            'link' => $this->generateUrl(),
        ]);
    }

    protected function generateUrl(): string
    {
        return route('auth.password.reset.form', ['token' => $this->token, 'email' => $this->user->email]);
    }
}
