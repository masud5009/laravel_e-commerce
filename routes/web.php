<?php

use App\Http\Controllers\Admin\{
    AdminController,
    BrandController,
    CategoryController,
    ChilCategoryController,
    CouponController,
    PageController,
    ProductController,
    SeoController,
    SmtpController,
    SubcategoryController,
    WarhouseCotroller
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
    Route::resource('page', PageController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::post('coupon/toggle-status/{coupon}', [CouponController::class,'toggleStatus'])->name('coupon.toggle-status');
    // SEO setting
    Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
    Route::post('seo', [SeoController::class, 'update'])->name('seo.update');
    // SMTP setting
    Route::get('smtp', [SmtpController::class, 'index'])->name('smtp.index');
    Route::post('smtp', [SmtpController::class, 'update'])->name('smtp.update');
    // Warhouse
    Route::get('warehouse',[WarhouseCotroller::class,'index'])->name('warhouse.index');
    Route::post('warehouse',[WarhouseCotroller::class,'store'])->name('warhouse.store');
    Route::get('/warehouse/{warehouse}/edit',[WarhouseCotroller::class,'edit'])->name('warehouse.edit');
    Route::delete('/warehouse/{warehouse}/delete',[WarhouseCotroller::class,'destory'])->name('warehouse.destory');
});


Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
