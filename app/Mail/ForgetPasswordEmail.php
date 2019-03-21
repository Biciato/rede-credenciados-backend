<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $url
    )
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recuperação de Senha')
                    ->markdown('emails.forget-password-email');
    }
}
