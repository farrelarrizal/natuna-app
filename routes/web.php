<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = [
        'head_title' => 'Selamat Lebaran',
    ];
    return view('comingsoon', $data);
});
