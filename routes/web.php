<?php

use App\Http\Controllers\Admin\{
    AdminController,
    BrandController,
    CategoryController,
    ChilCategoryController,
    SubcategoryController
};
use App\Models\Admin\ChildCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// SUPPER ADMIN ALL ROUTE
Route::prefix('admin/')->middleware('superAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin.index');
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubcategoryController::class);
    Route::resource('child-category', ChilCategoryController::class);
    Route::resource('brand', BrandController::class);
});


Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
