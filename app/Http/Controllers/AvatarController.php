<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class AvatarController extends Controller
{
    public function update(Request $request, $id, $filename)
    {
        // check if it's already have an avatar, deleting it in case of existence, storing it in case
        // of fails
        $files = Storage::disk('public')->files('avatars/' . $id);
        if ($files) {

            Storage::disk('public')->delete($files[0]);
        }

        $path = $request->file('avatar')->storeAs('avatars/' . $id,  $filename, 'public');

        return response()->json($path, 201);
    }

    public function updateAvatarUnidade(Request $request, $id, $unidadeId, $filename)
    {
        // check if it's already have an avatar, deleting it in case of existence, storing it in case
        // of fails
        $files = Storage::disk('public')->files('avatars/' . $id . '/unidades\/' . $unidadeId);
        if ($files) {

            Storage::disk('public')->delete($files[0]);
        }

        $path = $request->file('avatar')->storeAs('avatars/' . $id . '/unidades\/' . $unidadeId,
            $filename, 'public');

        return response()->json($path, 201);
    }

    public function show($id)
    {
        $avatar = Storage::disk('public')->files('avatars/' . $id);

        return response()->json($avatar, 201);

    }

    public function delete($id)
    {
        $files = Storage::disk('public')->files('avatars/' . $id);
        if ($files) {

            Storage::disk('public')->delete($files[0]);
        }
        return response()->json($files, 201);
    }

    public function showUnidadeAvatar($id, $unidadeId)
    {
        $avatar = Storage::disk('public')->files('avatars/' . $id . '/unidades\/' . $unidadeId);

        return response()->json($avatar, 201);

    }

    public function deleteUnidadeAvatar($id, $unidadeId)
    {
        $files = Storage::disk('public')->files('avatars/' . $id . '/unidades\/' . $unidadeId);
        if ($files) {

            Storage::disk('public')->delete($files[0]);
        }
        return response()->json($files, 201);
    }
}
