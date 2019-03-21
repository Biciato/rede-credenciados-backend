<?php

namespace App\Http\Controllers;

use App\Mail\FriendIndication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class FriendIndicationController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function email(Request $request)
    {
        $nome = $request->get('nome');
        $email = $request->get('email');
        $nome_indicado = $request->get('nome_indicado');
        $mensagem = $request->get('mensagem');

        Mail::to('leandrobiciato58@gmail.com')->send(new FriendIndication(
            $nome,
            $nome_indicado,
            $mensagem
        ));
    }

    public function sms(Request $request)
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('d4f32747', 'QsQSBHQk9UKlJQNF');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '55' . $request->get('tel'),
            'from' => 'Rede Credenciados',
            'text' => $request->get('message')
        ]);
    }
}