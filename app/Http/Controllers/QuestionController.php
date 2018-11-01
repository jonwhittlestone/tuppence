<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Starling;

class QuestionController extends Controller
{
    //
    public function balance()
    {
        $balance = 0;
        $identity = new Starling\Identity("sinu3aosbp97z1jdTGJBfmTpUEsceKT8p6ACy73frESXXYPMLTaJZSGaqZnYE11V");
        $client = new Starling\Api\Client($identity, ['env' => 'prod']);
        $request = new Starling\Api\Request\Accounts\Balance();

        try {
            $result = $client->request($request);
            $body = json_decode((string) $result->getBody(), true);
            $balance = $body['effectiveBalance'];

        } catch (Exception $e) {
                $balance = $e->getMessage();

        }
        return ['current_balance'   => $balance];
    }
}
