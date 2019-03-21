<?php

namespace App\Http\Controllers;

use App\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AtividadeController extends Controller
{

    public function register(Request $request)
    {
        /*
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        */

        $atividade = Atividade::create($request->all());

        return response()->json($atividade, 201);
    }

    public function index() 
    {       
        return response()->json(Atividade::all(), 201);
    }

    public function show($id) 
    {       
        return response()->json(Atividade::find($id), 201);
    }

    public function delete($id)
    {
        $atividade = Atividade::find($id);

        $atividade->delete();

        return response()->json($atividade, 201);
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
}