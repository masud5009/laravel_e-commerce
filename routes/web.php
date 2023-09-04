<?php

use App\Http\Controllers\Admin\{
    CategoryController,SubcategoryController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/a',function(){
    return view('admin.index');
});

//category route
Route::resource('category',CategoryController::class);
//subcategory route
Route::resource('sub-category',SubcategoryController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
