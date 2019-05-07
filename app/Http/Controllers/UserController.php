<?php

namespace App\Http\Controllers;

use App\User;
use App\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->get('email'))->first();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('user', 'token'), 201);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tipo_pessoa' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'tipo_pessoa' => $request->get('tipo_pessoa'),
            'password' => $request->get('password'),
        ]);

        $token = JWTAuth::fromUser($user);

        if ($user) {
            $mensagem = <<<HDC
                    Seja Bem Vindo ao sistema Rede Credenciados

                    Nossa equipe agradece a confiança em nosso sistema. E estamos sempre à disposição para qualquer dúvidas, sugestões e reclamações.

                    Para entrar em contato, basta usar nosso e-mail contato@redecredenciados.com.br.

                    Agradecemos pela atenção.

                    Equipe Rede Credenciados.
HDC;

            Mensagem::create([
                'especialidades' => 'todas',
                'titulo' => 'Bem Vindo',
                'mensagem' => $mensagem,
                'mensagem_lida' => 0
            ]);
        }

        return response()->json($user, 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->update(['password'=>$request->get('newPassword')]);

        return response()->json($user, 201);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->tipo_pessoa == 'pessoa_fisica') {
            $pessoa_fisica = $user->pessoaFisica;
            $pessoa_fisica->endereco()->delete();
            $pessoa_fisica->atividade()->delete();
            $pessoa_fisica->apresentacao()->delete();
            $pessoa_fisica->delete();

            $user->delete();

            return response()->json(201);
        } else {
            $pessoa_juridica = $user->pessoaJuridica;
            $unidades = $pessoa_juridica->unidades;
            foreach ($unidades as $unidade) {
                $unidade->endereco()->delete();
                $unidade->atividade()->delete();
                $unidade->apresentacao()->delete();
                $unidade->delete();
            }
            $pessoa_juridica->endereco()->delete();
            $pessoa_juridica->atividade()->delete();
            $pessoa_juridica->apresentacao()->delete();
            $pessoa_juridica->delete();

            $user->delete();

            return response()->json(201);
        }
    }

    public function checkUserEmail($email) {
        $user = User::where('email', $email)->first();

        return response()->json($user, 201);
    }

    public function user($id)
    {
        $user = User::find($id);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json($user, 201);
    }
}
