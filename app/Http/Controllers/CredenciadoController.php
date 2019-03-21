<?php

namespace App\Http\Controllers;

use App\PessoaFisica;
use App\PessoaJuridica;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class CredenciadoController extends Controller
{
    public function index()
    {
        $credenciados = [];
        $credenciados_pf = DB::table('users')
            ->join('pessoa_fisicas', 'users.id', '=', 'pessoa_fisicas.user_id')
            ->join('endereco_pessoa_fisicas', 'pessoa_fisicas.id', 'endereco_pessoa_fisicas.pessoa_fisica_id')
            ->select(
                'users.id',
                'users.tipo_pessoa', 
                'users.email', 
                'pessoa_fisicas.nome', 
                'pessoa_fisicas.tel',   
                'pessoa_fisicas.tel2',   
                'pessoa_fisicas.cel',
                'endereco_pessoa_fisicas.cidade'   
            )
            ->get();

        $credenciados_pj = DB::table('users')
            ->join('pessoa_juridicas', 'users.id', '=', 'pessoa_juridicas.user_id')
            ->join('endereco_pessoa_juridicas', 'pessoa_juridicas.id', 'endereco_pessoa_juridicas.pessoa_juridica_id')
            ->select(
                'users.id',
                'users.tipo_pessoa', 
                'users.email', 
                'pessoa_juridicas.nome_fantasia', 
                'pessoa_juridicas.razao_social', 
                'pessoa_juridicas.tel',   
                'pessoa_juridicas.tel2',   
                'pessoa_juridicas.cel',
                'endereco_pessoa_juridicas.cidade'      
            )
            ->get();    

        foreach ($credenciados_pf as $item) {
            array_push($credenciados, $item);
        }

        foreach ($credenciados_pj as $item) {
            array_push($credenciados, $item);
        }

        return response()->json($credenciados, 201);    
    }
}