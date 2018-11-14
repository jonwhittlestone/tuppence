<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Starling;

class BudgetingConversation extends Conversation
{
    public function __construct() 
    {
        // set up API Wrapper identity/client
        $this->identity = new Starling\Identity(
            env('TUPPENCE_STARLING_CLIENT_IDENTITY')
        );

        $this->client = new Starling\Api\Client(
            $this->identity, 
            ['env' => env('TUPPENCE_STARLING_CLIENT_ENV')
]
        );
    }

    public function stopsConversation(IncomingMessage $message)
    {
        return true;
    }

    public function run()
    {
        $allowedAnswers = __('bot.allowedAnswers');

        $this->ask("Please enter a selection, or type 'help' for a list of options:", [
            'pattern'   => 'balance',
            'callback'  => function() {
                $this->sayBalance();
                $this->stopsConversation();
            }
        ]);

        //$this->ask(
            //"Please enter a selection, or type 'help' for a list of options:",
            //function ($answer) use ($allowedAnswers) {
                //if (!in_array($answer->getText(), $allowedAnswers)) {
                    //return $this->repeat('This is not a valid answer'."\n");
                //}

                //if ($answer->getText() === 'balance') {
                    //$this->sayBalance();
                    //$this->stopsConversation();
                //}

                //if ($answer->getText() === 'dd') {
                    //$this->sayDirectDebits();
                //}
            //}
        //);
    }

    protected function sayDirectDebits()
    {
        $this->say('Your direct debits in a month are: ');

        $request = new Starling\Api\Request\DirectDebits();

        try {
            $result = $this->client->request($request);
            $body = json_decode((string) $result->getBody(), true);

            foreach ($body[ '_embedded' ]['mandates'] as $m) {
                $this->say($m['created'] . " - " . $m['reference']);
            }

        } catch (Exception $e) {
            $this->say($e->getMessage());
        }
    }


    public function sayBalance()
    {

        $balance = 0;


        $request = new Starling\Api\Request\Accounts\Balance();

        try {
            $result = $this->client->request($request);
            $body = json_decode((string) $result->getBody(), true);
            $balance = $body['effectiveBalance'];

        } catch (Exception $e) {
                $balance = $e->getMessage();

        }

        $this->say('£ '.$balance);
    }

}
