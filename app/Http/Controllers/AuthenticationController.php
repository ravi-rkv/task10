<?php

namespace App\Http\Controllers;

use App\Helper\ApiHelper;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthenticationController extends Controller
{
    // Registration
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return ApiHelper::apiResponse('422', $validator->errors()->first(), []);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $token = $user->createToken('api_token')->plainTextToken;

        return ApiHelper::apiResponse('200', 'Request Completed Successfully', ['token' => $token]);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return ApiHelper::apiResponse('401', 'Invalid Credentials', []);
        }

        $user = auth()->user();
        $user->tokens()->delete();

        // Generate new API token
        $token = $user->createToken('api_token')->plainTextToken;
        return ApiHelper::apiResponse('200', 'Request Completed Successfully', ['token' => $token]);


    }
}
