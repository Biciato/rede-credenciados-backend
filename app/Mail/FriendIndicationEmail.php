<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendIndicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $nome_indicado;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nome,
        $nome_indicado,
        $mensagem
    )
    {
        $this->nome = $nome;
        $this->nome_indicado = $nome_indicado;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Você tem uma indicação de um amigo')
                    ->markdown('emails.friendindication');
    }
}
