<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Front\FrontNewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/news/delete-selected', [NewsController::class, 'deleteSelectedNews'])->name('news.selected.delete');
    Route::resource('/news', NewsController::class);
    Route::resource('/category', CategoryController::class)->except(['create', 'edit']);
    Route::resource('/media', ImageController::class);
    Route::resource('/navigation/header', MenuController::class);
    Route::get('/ajax/media/{id}', [AjaxController::class, 'getImage'])->name('ajax.media.get-image');
    Route::get('/ajax/get-category', [AjaxController::class, 'getCategory'])->name('ajax.get.category');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [FrontNewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [FrontNewsController::class, 'show'])->name('news.show');

require __DIR__ . '/auth.php';
