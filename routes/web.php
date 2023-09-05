<?php

use App\Http\Controllers\Admin\{
    BrandController,
    CategoryController, ChilCategoryController, SubcategoryController
};
use App\Models\Admin\ChildCategory;
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
//Childcategory route
Route::resource('child-category',ChilCategoryController::class);
//Childcategory route
Route::resource('brand',BrandController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
