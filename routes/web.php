<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\PhotoAlbumController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\MyBlogController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CollectStatistics;
use Illuminate\Support\Facades\Route;

// Группа маршрутов для пользовательской части сайта с применением middleware для сбора статистики
Route::middleware([CollectStatistics::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
    Route::get('/interests', [InterestsController::class, 'index'])->name('interests');
    Route::get('/photoalbum', [PhotoAlbumController::class, 'index'])->name('photoalbum');
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
    Route::get('/myblog', [MyBlogController::class, 'index'])->name('myblog.index');
    Route::get('/test-results', [TestController::class, 'showResults'])->name('test.results');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
});


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Маршруты, не требующие сбора статистики
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');
Route::post('/contacts', [ContactsController::class, 'submit'])->name('contacts.submit');
Route::post('/test', [TestController::class, 'submit'])->name('test.submit');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Маршруты для админ-панели (без сбора статистики)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Маршруты для админ-панели (без сбора статистики)
Route::middleware(AdminAuthMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/blog-editor', [AdminController::class, 'blogEditor'])->name('admin.blog_editor');
    Route::post('/blog-editor', [AdminController::class, 'store'])->name('admin.blog_editor.store');
    Route::delete('/blog-editor/{id}', [AdminController::class, 'destroy'])->name('admin.blog_editor.destroy');
    Route::get('/guestbook-upload', [AdminController::class, 'guestbookUpload'])->name('admin.guestbook_upload');
    Route::post('/guestbook-upload', [AdminController::class, 'uploadGuestbook'])->name('admin.guestbook_upload.post');
    Route::get('/upload-csv', [AdminController::class, 'showUploadForm'])->name('admin.upload_csv');
    Route::post('/upload-csv', [AdminController::class, 'uploadCsv'])->name('admin.upload_csv.post');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');

});