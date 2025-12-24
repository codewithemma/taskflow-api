<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // @route POST /register
    // @desc Register a new user
    public function register(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
        'fullname' => 'required|string|max:100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash pasword
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create user
        $user = User::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Your account is ready. You can now log in and get started.',
            'doc' => $user
        ]);
    }
}
