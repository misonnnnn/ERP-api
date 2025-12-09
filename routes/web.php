<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-artisan/{command}', function ($command) {
    // Security: allow only specific commands
    $allowed = [
        'migrate',
        'config:cache',
        'route:clear',
        'view:cache',
        'storage:link',
        'optimize',
        'db:seed',
    ];

    if (! in_array($command, $allowed)) {
        return "Command not allowed.";
    }

    \Illuminate\Support\Facades\Artisan::call($command);

    return "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
});
