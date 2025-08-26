<?php

use App\Data\UserData;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return UserData::from([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});
