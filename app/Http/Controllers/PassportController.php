<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function buildQuery()
    {
        $query = http_build_query([
            'client_id' => 11,
            'redirect_uri' => 'http://pink-croc-auction.test/callback',
            'response_type' => 'code',
            'scope' => ''
        ]);
        return redirect('/oauth/authorize?'.$query);
    }

    public function getToken(Request $request)
    {
        $http = new GuzzleHttp\Client;

        $response = $http->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'id' => 11,
                'secret' => 'B45U9pCF4MOk64Z6mEpzlt6nnpa6xcc5fkWdGbYE',
                'redirect_uri' => 'http://pink-croc-auction.test/callback',
                'code' => $request->code
            ]
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
