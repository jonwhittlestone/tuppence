<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Starling;

class BudgetingConversation extends Conversation
{
    public function run()
    {
        $allowedAnswers = __('bot.allowedAnswers');
        $help = __('bot.help');
        $welcome = __('bot.welcome');
    

        $this->ask(
            $welcome."\n". $help,
            function ($answer) use ($allowedAnswers, $help) {
                if (!in_array($answer->getText(), $allowedAnswers)) {
                    return $this->repeat('This is not a valid answer'."\n$help");
                }

                if ($answer->getText() === 'balance') {
                    $this->sayBalance();
                }
            }
        );
    }

    protected function sayBalance()
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

        $this->say('£ '.$balance);
    }

}
