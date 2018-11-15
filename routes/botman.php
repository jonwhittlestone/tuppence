<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\Middleware\Dialogflow;
use App\Http\Conversations\BudgetingConversation;



$botman = app('botman');

$help = __('bot.help');
$welcome = __('bot.welcome');

$botman->reply($welcome."\n" . $help); 

/* Use NLP service to get budget */
$dialogflow = Dialogflow::create(env('DIALOGFLOW_CLIENT_ACCESS_TOKEN'))
    ->listenForAction();
$botman
    ->middleware
    ->received($dialogflow);

//$botman
    //->hears('getbalance', BotManController::class.'@balance')
    //->middleware($dialogflow);

$botman
    ->hears('balance', BotManController::class.'@balance');

//$botman->hears('budget', function($bot){
    //$bot->startConversation(new BudgetingConversation);
//});

$botman->hears('help', function($bot) {
    $help = __('bot.help');
    $bot->reply($help);
})->skipsConversation();

$botman->hears('exit', function ($bot)  {
    $bot->reply('Exited from the budget conversation');
})->stopsConversation();

Route::post('/botman', function() {
    app('botman')->listen();
});
