<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\PdfUploadController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\BaithakController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
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

// Gallery Route
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Committee Members Route
Route::get('/committee', [CommitteeController::class, 'index'])->name('committee.index');

// 84 Baithakji Route
Route::get('/baithakji', [BaithakController::class, 'index'])->name('baithak.index');

// Family Directory Routes
Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::get('/families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('/members', [FamilyController::class, 'index'])->name('members.index');
Route::get('/members/{family}', [FamilyController::class, 'show'])->name('members.show');

// Admin Actions & Ingestion Endpoints (Used by Filament Admin Panel)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/pdf-upload/process', [PdfUploadController::class, 'processPdf'])->name('pdf.process');
    Route::post('/pdf-upload/save', [PdfUploadController::class, 'saveExtractedData'])->name('pdf.save');

    Route::get('/tools/export-families', [ToolController::class, 'exportFamilies'])->name('tools.export.families');
    Route::get('/tools/export-members', [ToolController::class, 'exportMembers'])->name('tools.export.members');
    Route::get('/tools/duplicates', [ToolController::class, 'checkDuplicates'])->name('tools.duplicates');
});

// About & Contact
Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
