<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


//schedule expired secrets to be deleted everyday   at 00:00
Schedule::call(function () {
    $secrets = \App\Models\Secret::where('expires_at', '<=', now())->get();
    foreach ($secrets as $secret) {
        $secret->delete();
    }
})->dailyAt('10:50');




