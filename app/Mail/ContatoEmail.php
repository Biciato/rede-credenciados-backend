<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $tel;
    public $cel;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nome,
        $email,
        $tel,
        $cel,
        $mensagem
    )
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->tel = $tel;
        $this->cel = $cel;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mensagem de cliente')    
                    ->markdown('emails.contato-email');
    }
}
