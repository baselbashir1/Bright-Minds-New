<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh', 'logout']]);
    }

    public function register(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'min:8'],
                'age' => ['required', 'numeric'],
                'gender' => ['required', 'string'],
            ]);

            $user = User::create([
                'name' => $validatedRequest['name'],
                'email' => $validatedRequest['email'],
                'password' => bcrypt($validatedRequest['password']),
                'age' => $validatedRequest['age'],
                'gender' => $validatedRequest['gender'],
            ]);

            $token = Auth::guard('api')->login($user);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 424);
        }
    }

    public function login(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            $token = Auth::guard('api')->attempt(['email' => $validatedRequest['email'], 'password' => $validatedRequest['password']]);

            if (!$token) {
                return response()->json(['Unauthorized' => 'Username or password incorrect.'], 401);
            }

            $user = Auth::guard('api')->user();

            return response()->json(['token' => $token, 'user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 424);
        }
    }

    public function logout()
    {
        try {
            Auth::guard('api')->logout();
            return response()->json(['message' => 'Logged out'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 424);
        }
    }


    // public function refresh()
    // {
    //     try {
    //         return response()->json([
    //             'status' => 'success',
    //             'user' => Auth::guard('api')->user(),
    //             'authorization' => [
    //                 'token' => Auth::guard('api')->refresh(),
    //                 'type' => 'bearer',
    //             ]
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 424);
    //     }
    // }
}
