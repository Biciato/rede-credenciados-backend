<?php

namespace App\Http\Controllers;

use App\PessoaJuridica;
use App\ApresentacaoPessoaJuridica;
use App\EnderecoPessoaJuridica;
use App\AtividadePessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegistroInicialPessoaJuridicaController extends Controller
{
    public function register(Request $request)
    {
        $pessoa_juridica = PessoaJuridica::find($request->get('id'));

        $pessoa_juridica->endereco()->create([
            'cep' => '',
            'rua' => '',
            'numero' => '',
            'complemento' => '',
            'bairro' => '',
            'cidade' => '',
            'estado' => ''
        ]);

        $pessoa_juridica->atividade()->create(['atividades' => $request->get('atividades')]);

        $pessoa_juridica->apresentacao()->create(['apresentacao' => '']);

        return response(201);
    }
}