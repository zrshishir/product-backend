<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 1, 'statusCode' => 400, 'message' => 'The email or password does not match.', 'data' => ""]);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 1, 'statusCode' => 500, 'message' => 'OOps, can not create token. Something went wrong.', 'data' => ""]);
        }

        return response()->json(['error' => 0, 'statusCode' => 200, 'message' => 'Wow, you are logged in.', 'data' => ""]);
    }

    public function register(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if($validator->fails()){
                $errors = $validator->errors();
                $errorMsg = "";
    
                foreach ($errors->all() as $msg) {
                    $errorMsg .= $msg;
                }
    
                return response()->json(['error' => 1, 'statusCode' => 422, 'message' => $errorMsg, 'data' => ""]);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(['error' => 0, 'statusCode' => 200, 'message' => "Great, Registration succeeded. You are now logged in.", 'data' => ['token' => $token, 'user' => $user]]);
    }


}
