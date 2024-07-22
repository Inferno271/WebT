<?php

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



Route::get('/myblog', [MyBlogController::class, 'index'])->name('myblog.index');

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/interests', [InterestsController::class, 'index'])->name('interests');
Route::get('/photoalbum', [PhotoAlbumController::class, 'index'])->name('photoalbum');
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');
Route::get('/upload', [UploadController::class, 'showForm']);
Route::post('/upload', [UploadController::class, 'uploadFile']);
Route::get('/test-results', [TestController::class, 'showResults'])->name('test.results');


Route::post('/contacts', [ContactsController::class, 'submit'])->name('contacts.submit');
Route::post('/test', [TestController::class, 'submit'])->name('test.submit');


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/blog-editor', [AdminController::class, 'blogEditor'])->name('admin.blog_editor');
    Route::post('/blog-editor', [AdminController::class, 'blogEditor'])->name('admin.blog_editor');
    Route::get('/guestbook-upload', [AdminController::class, 'guestbookUpload'])->name('admin.guestbook_upload');
    Route::get('/upload-csv', [AdminController::class, 'showUploadForm'])->name('admin.upload_csv');
    Route::post('/upload-csv', [AdminController::class, 'uploadCsv'])->name('admin.upload_csv');

});


