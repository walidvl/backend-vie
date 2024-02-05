<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:4',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            // Optionally, you can generate a token for the user here (for authentication).

            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (ValidationException $e) {
            // Validation failed; return validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


//login

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Create a custom token

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    } else {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

// public function loggoogle(Request $request)
// {

//     try {
//         $googleUser = Socialite::driver('google')->userFromToken($request->token);

//         // Check if the user already exists
//         $user = User::where('email', $googleUser->getEmail())->first();

//         if (!$user) {
//             // Create a new user if not exists
//             $user = User::create([
//                 'name' => $googleUser->getName(),
//                 'email' => $googleUser->getEmail(),
//                 'password'=>'walidnhaila',
//                 // Add other necessary fields
//             ]);
//         }

//         // Log in the user
//         auth()->login($user);

//         // You can return user data or a token if needed
//         return response()->json(['user' => $user], 200);
//     } catch (\Exception $e) {
//         // Handle error
//         return response()->json(['error' => 'Google login error'], 500);
//     }
// }


}