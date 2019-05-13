<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function email(Request $request)
    {
        $email = $request->get('email');
        $id = $request->get('id');
        $url = $url = 'http://localhost:4200/reset-password?id=' . $id;

        Mail::to('leandrobiciato58@gmail.com')->send(new ForgetPasswordEmail($url));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        // checking if password matches
        if ($user->email === $request->get('email')) {
            $user->update(['password'=> $request->get('password')]);

            return response()->json($user, 201);
        } else {
            return response()->json('E-mail não confere', 201);
        }
    }
}
