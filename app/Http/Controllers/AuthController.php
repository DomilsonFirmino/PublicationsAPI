<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $attr = $request->validated();

        $attr['img']='https://placehold.co/600x400';

        $user = User::create($attr);

        $token = $user->createToken($attr['username']);

        return ['user'=>$user,'token'=>$token->plainTextToken];
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !(Hash::check($request->password,$user->password))){
            return ['errors' => ['password'=>['credentials do not meeet creterias']]];
        }

        $token = $user->createToken($user->username);

        return ['user'=>$user,'token'=>$token->plainTextToken];
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'you are logged out'
        ];
    }
}
