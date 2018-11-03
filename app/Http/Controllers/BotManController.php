<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;

use Starling;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $this->botman = app('botman');

        $this->botman->listen();
    }

    //
    public function balance($bot)
    {
        $balance = 0;

        $identity = new Starling\Identity(
            env('TUPPENCE_STARLING_CLIENT_IDENTITY')
        );

        $client = new Starling\Api\Client($identity, ['env' => 'prod']);
        $request = new Starling\Api\Request\Accounts\Balance();

        try {
            $result = $client->request($request);
            $body = json_decode((string) $result->getBody(), true);
            $balance = $body['effectiveBalance'];

        } catch (Exception $e) {
                $balance = $e->getMessage();

        }

        $bot->reply('Starling Current Account balance: £' . $balance);
    }
}
