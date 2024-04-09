<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = [
        'head_title' => 'Coming Soon Page',
    ];
    return view('comingsoon', $data);
});
