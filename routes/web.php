<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', HomeController::class)->name('home');

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/upcoming', [EventController::class, 'upcoming'])->name('events.upcoming');
Route::get('/events/past', [EventController::class, 'past'])->name('events.past');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

// Community Member Routes
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');

// About & Contact
Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
