<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        Log::info('Login method called');
        $this->validate($request, [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = $this->determineLoginType($request->input('login'));

        $credentials = [];

        if ($loginType === 'mobile_number') {
            $mobileNumber = strlen($request->input('login')) === 11 ? $request->input('login') : '266' . $request->input('login');
            $credentials = [
                'mobile_number' => $mobileNumber,
                'password' => $request->input('password'),
            ];
        } else {
            $credentials = [
                'email' => $request->input('login'),
                'password' => $request->input('password'),
            ];
        }

        if (Auth::attempt($credentials)) {
            // Retrieve the authenticated user
            $user = Auth::user();

            // Create and return a token
            $token = $user->createToken('auth-token');

            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }

        // Return a JSON response for authentication failure
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
