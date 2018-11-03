<?php

use App\Http\Controllers\BotManController;

$botman = app('botman');

$botman->hears('balance',
    BotManController::class.'@balance'
);

Route::post('/botman', function() {
    app('botman')->listen();
});
