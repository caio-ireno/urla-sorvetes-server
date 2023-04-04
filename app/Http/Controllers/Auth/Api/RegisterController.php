<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request, User $user){

        $userData = $request ->only('name','email','password');
        $userData['password'] = bcrypt($userData['password']);
        if(!$user = $user->create($userData)) abort(500, 'Erro ao criar Usuario...');

        return response()->json([
            'data'=>[
                'user'=>$user
             ]
            ]);
    }
}
