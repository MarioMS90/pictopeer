<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Las credenciales no son correctas',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken()->get());

            return response()->json([
                'success' => true,
                'message' => 'Usuario deslogueado satisfactoriamente'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario no puede ser deslogueado'
            ], 500);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alias' => ['required', 'string', 'max:35', 'unique:users'],
            'email' => [
                'required', 'string', 'email', 'max:60', 'unique:users'
            ],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        User::create([
            'alias' => $request->alias,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);

        return $this->login($request);
    }
}
