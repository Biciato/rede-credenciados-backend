<?php

namespace App\Http\Controllers;

use App\PessoaFisica;
use App\ApresentacaoPessoaFisica;
use App\EnderecoPessoaFisica;
use App\AtividadePessoaFisica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegistroInicialPessoaFisicaController extends Controller
{
    public function register(Request $request)
    {
        $pessoa_fisica = PessoaFisica::find($request->get('id'));

        $pessoa_fisica->endereco()->create([
            'cep' => '',
            'rua' => '',
            'numero' => '',
            'complemento' => '',
            'bairro' => '',
            'cidade' => '',
            'estado' => ''
        ]);

        $pessoa_fisica->atividade()->create(['atividades' => $request->get('atividades')]);

        $pessoa_fisica->apresentacao()->create(['apresentacao' => '']);

        return response(201);
    }
}