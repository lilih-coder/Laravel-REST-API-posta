<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user->makeHidden(['password', 'remember_token']),
        ]);
    }
}
