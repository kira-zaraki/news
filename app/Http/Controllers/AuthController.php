<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $device_name = $request->device_name ?? 'postman';
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
    }
 
    return response()->render(
                [
                    'status' => 'success',
                    'message' => 'user successfully logged',
                    'data' => $user->createToken($device_name.$user->name.'_Token')->plainTextToken,
                ]
            );
    }
}
