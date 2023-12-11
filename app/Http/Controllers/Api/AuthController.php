<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),
        [
            'email' =>'required|string|email',
            'password' =>'required|string'    
        ]);

     
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 400);
        }

        $user = User::where('email' , $request->email)->first();
        

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('There is an error in the email or password ' , 401);
        }

  

        $token = $user->createToken('myappToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User successfully signed out']);
    }
  
}
