<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuestWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $user_password;

    public function __construct($data, $user_password)
    {
        $this->data = $data;
        $this->user_password = $user_password;
    }

    public function build()
    {
        return $this->markdown('emails.guest_welcome')
                    ->subject('Welcome to ' . config('app.name'));
    }
}
