<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->everySixHours();

Artisan::command('test', function () {
    Log::info('Test Commandd');
})->purpose('Scrive test ogni secondo!')->everyTenSeconds();

Schedule::command('test');
