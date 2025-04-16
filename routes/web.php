<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/category',function () {
    return view('category.index');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/category',[CategoryController::class, 'fetchCategoryData']);
Route::post('/addCategory', [CategoryController::class, 'insertCategory'])->name('addCategory');
Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('categories.destroy');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);

require __DIR__.'/auth.php';
