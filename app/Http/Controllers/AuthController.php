<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;


class AuthController extends Controller

{
    public function index(Request $request)
    {
        $bodyContent = $request->getContent();
        //return response()->json(json_decode($bodyContent));
    }

    public function getUser(Request $request)
    {
        $cpf = $request->input('cpf');
        $user = User::where('cpf', $cpf)->first();

        if (User::where('cpf', $cpf)->exists()) {
            return response()->json($user); // your code...
        } else {
            $errorMessage = [
                'message'   => 'Usuário não encontrado.',
            ];

            return response()->json($errorMessage, 404);
        }
    }
}
