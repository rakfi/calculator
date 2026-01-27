<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', fn() => view('home'))->name('home');

// About page
Route::get('/about', fn() => view('about'))->name('about');

// Services page
Route::get('/services', fn() => view('services'))->name('services');

// Tax Calculators page
Route::get('/tax-calculators', fn() => view('tax-calculators'))->name('tax.calculators');

// News page
Route::get('/news', fn() => view('news'))->name('news');

// Downloads page (used in navbar dropdown)
Route::get('/downloads', fn() => view('downloads'))->name('downloads');

// Contact page
Route::get('/contact', fn() => view('contact'))->name('contact');

// Login page
Route::get('/login', fn() => view('login'))->name('login');
