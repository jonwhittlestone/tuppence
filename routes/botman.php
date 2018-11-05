<?php

use App\Http\Controllers\BotManController;
use App\Http\Conversations\BudgetingConversation;

//use BotMan\BotMan\Drivers\DriverManager;
//use BotMan\BotMan\BotManFactory;

//DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

// Create BotMan instance
//BotManFactory::create($config);

$botman = app('botman');

//$botman->hears('balance',
    //BotManController::class.'@balance'
//);

$startBot = __('bot.startBot');
$botman->reply($startBot);

$botman->hears('budget', function($bot){
    $bot->startConversation(new BudgetingConversation);
});

$botman->hears('help', function($bot) {
    $help = __('bot.help');
    $bot->reply($help);
})->skipsConversation();

$botman->hears('exit', function ($bot)  {
    $bot->reply('Exitted from the budget conversation');
})->stopsConversation();

Route::post('/botman', function() {
    app('botman')->listen();
});
