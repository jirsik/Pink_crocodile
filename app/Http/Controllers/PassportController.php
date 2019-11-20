<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\OauthAccessToken;

class PassportController extends Controller
{
    // public function buildQuery()
    // {
    //     $query = http_build_query([
    //         'client_id' => 12,
    //         'redirect_uri' => 'http://www.pink-croc-auction.test/callback',
    //         'response_type' => 'code',
    //         'scope' => ''
    //     ]);
    //     return redirect('/oauth/authorize?'.$query);
    // }

    // public function getToken(Request $request)
    // {
    //     $http = new GuzzleHttp\Client;

    //     $response = $http->post('http://www.pink-croc-auction.test/oauth/token', [
    //         'form_params' => [
    //             'grant_type' => 'password',
    //             'client_id' => 12,
    //             'client_secret' => '0SecNkqNQWgDew1COi0LRQyOm42iwv6I2BurCjUr',
    //             'username' => 'Fiona@email.com',
    //             'password' => 'rootroot',
    //             'scope' => '',
    //         ],
    //     ]);

    //     return json_decode((string) $response->getBody(), true);
    // }

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
        $token = $user->createToken('remember_token')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (auth()->attempt($credentials)) {
            $token = Auth::user()->createToken('remember_token')->accessToken;
            return response()->json([
                'id' => Auth::user()->id,
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

    public function checkToken(Request $request)
    {
        // return $request->token;
        return [
            'verified' => true
        ];
        // $access_token = OauthAccessToken::findOrFail("eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI4IiwianRpIjoiNTRkMzI3NjIyMTJlNTI3NTJkMjkyN2JiZmQyMWUwNzRlNjJhNGZlN2RhNTM3MjAyZjA4NGMzOGQzNGJkNTQxZDg3N2ZiZWJjMzVhZDcyNWYiLCJpYXQiOjE1NzM5ODAxODAsIm5iZiI6MTU3Mzk4MDE4MCwiZXhwIjoxNjA1NjAyNTgwLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.YJljGMxsm4Z9nOMkF240WuLa5cooo_6wlRdNIi-ZivAu-4Qa_TwFAV2y7T7g0uBD_nkBPqH6r-uubHObrxF36qa0s590qBigWS5cCrxRwD_EltouPy262HfOwl4atHANGYLbQh2R8tKBUqjzeYB2BIX3Zuh1xMDxnVf7u9tdEJLrFY4Jum6EHqJ6arX0kA5_Kf8_ojR9xdC1Uin0z4bzYQsr27zlQTdkhbbqHAamIFWBvctje7uofUJURCNuXkbmZP5yz_tkeXKXce_0PXdft0DonxUpk-vt3bm6iLZrbnea0FPTneYX5-r_XmJqwIWi5e_PevVwBMJ0Zu2SqwhryEdaaSiaXZxpnm6e16071W2zjxcRYpLvDlTVdzN77xtlbcJ3zuqDZDhLxZhrWtw8Wse2mIUXBUtiYmj7IT-K9hPOcRL463Dlnly1vqaZZ7x8puDfKStnSnlVMakvVoCqe57YCf5Y-OXQElES8NOXvKxh3xJBnqSDKmrjszZk7xcRpv8Ihh11Tbu4-zjaQo6ajlQNBmuvuP8csRGBL_4GHfy4MkE7if7Z2ZtxTp0_eh0eXSuv4amvRk3AWnWaGSGmWfkiRl3VopZPMqduufVyRwLBVnm8yHvfD7HwA6bgUDwXaVYHir6-off5dlQevEHA3nDfclrgiyN1g_wS2imOwWA");
        // return $access_token;
        // if ($access_token->user_id == $request->id) {
        //     return response()->json([
        //         'verified' => true
        //     ]);
        // }
        // return response()->json([
        //     'verified' => false
        // ]);
    }
}
