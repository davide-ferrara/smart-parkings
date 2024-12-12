<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['name' => 'dave']);
});

Route::get('/admin', function () {
    return view('admin.panel');
});

Route::get('/admin/add_parking', function () {
    return view('admin.add_parking');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});