<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = validator($request->all(),[
            'username' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()], 400);
        }

        try{
            $data = [
                'username'=>$request->username,
                'password'=> $request->password
            ];

            $user = User::where('email', $data['username'])->first();
            if(!$user || !Hash::check($data['password'], $user->password)){
                return response([
                    'message'=> 'Bad creds'
                ], 401);
            }

            $token = $user->createToken('token_name')->plainTextToken;
            $response = ['token'=>$token, 'user'=> $user];

            return response()->json($response);
        }catch(\Exception $e){
            if($e->getCode() == 400){
                return response()->json('Invalid request', $e->getCode());
            }else if($e->getCode() == 401){
                return response()->json('Invalid request', $e->getCode());
            }else{
                return response()->json('Invalid request', $e->getCode());
            }
        }
    }

    public function logOut(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg'=> 'Logged out']);
    }
}

