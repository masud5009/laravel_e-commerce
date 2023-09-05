<?php

use App\Http\Controllers\Admin\{
    AdminController,
    BrandController,
    CategoryController,
    ChilCategoryController,
    SeoController,
    SubcategoryController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// SUPPER ADMIN ALL ROUTE
Route::prefix('admin/')->middleware('superAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin.index');
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubcategoryController::class);
    Route::resource('child-category', ChilCategoryController::class);
    Route::resource('brand', BrandController::class);
    // seo setting
    Route::get('seo',[SeoController::class,'index'])->name('seo.index');
    Route::post('seo',[SeoController::class,'update'])->name('seo.update');
});


Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
