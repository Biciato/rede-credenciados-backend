<?php

namespace App\Http\Controllers;

use App\Mail\FriendIndicationEmail;
use App\FriendIndication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class FriendIndicationController extends Controller
{
    public function create(Request $request)
    {
        $friendIndication = FriendIndication::create($request->all());

        return response()->json($friendIndication, 201);
    }

    public function update($id)
    {
        // updating updated_at column
        $friendIndication = FriendIndication::find($id)->touch();

        return response()->json($friendIndication, 201);
    }
    public function index()
    {
        $friendIndications = FriendIndication::all();

        return response()->json($friendIndications, 201);
    }

    public function email(Request $request)
    {
        $nome = $request->get('nome');
        $email = $request->get('email');
        $nome_indicado = $request->get('nome_indicado');
        $mensagem = $request->get('mensagem');

        Mail::to('leandrobiciato58@gmail.com')->send(new FriendIndicationEmail(
            $nome,
            $nome_indicado,
            $mensagem
        ));
    }

    public function sms(Request $request)
    {
        // sending SMS text
        $basic  = new \Nexmo\Client\Credentials\Basic('d4f32747', 'QsQSBHQk9UKlJQNF');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '55' . $request->get('tel'),
            'from' => 'Rede Credenciados',
            'text' => $request->get('message')
        ]);
    }
}
