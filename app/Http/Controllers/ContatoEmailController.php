<?php

namespace App\Http\Controllers;

use App\Mail\ContatoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ContatoEmailController extends Controller
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
        $email_to = $request->get('email_to');
        $tel = $request->get('tel');
        $cel = $request->get('cel');
        $mensagem = $request->get('mensagem');

        Mail::to('leandrobiciato58@gmail.com')->send(new ContatoEmail(
            $nome,
            $email,
            $tel,
            $cel,
            $mensagem
        ));
    }
}