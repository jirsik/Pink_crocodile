<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\OauthAccessToken;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);
        $user->role()->attach(2);
        $user->save();

        $token = $user->createToken('remember_token')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (auth()->attempt($credentials)) {
            $token = Auth::user()->createToken('remember_token')->accessToken;
            return response()->json([
                'user' => Auth::user(),
                'token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Authorized'
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'successfully logged out!']);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        return response()->json(['submit' => true]);
    }

    
}
