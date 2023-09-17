<?php

use App\Http\Controllers\Admin\{
    AdminController,
    AttributeController,
    AttributeValueController,
    BrandController,
    CategoryController,
    ChilCategoryController,
    ColorController,
    CouponController,
    MailSettringController,
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
    //category all route
    Route::resource('category', CategoryController::class);
    Route::get('pagination/paginate-data', [CategoryController::class, 'pagination']);
    Route::get('category/search', [CategoryController::class, 'search'])->name('category.search');

    Route::resource('sub-category', SubcategoryController::class);
    Route::resource('child-category', ChilCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('page', PageController::class);
    Route::resource('product', ProductController::class);
    Route::resource('color', ColorController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('attribute-value', AttributeValueController::class);
    Route::resource('mail-setting', MailSettringController::class);
    // Coupon Routes
    Route::resource('coupon', CouponController::class);
    Route::post('coupon/toggle-status/{coupon}', [CouponController::class, 'toggleStatus'])->name('coupon.toggle-status');
    // SEO setting Routes
    Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
    Route::post('seo', [SeoController::class, 'update'])->name('seo.update');
    // SMTP setting Routes
    Route::get('smtp', [SmtpController::class, 'index'])->name('smtp.index');
    Route::post('smtp', [SmtpController::class, 'update'])->name('smtp.update');
    // Warhouse Routes
    Route::get('warehouse', [WarhouseCotroller::class, 'index'])->name('warhouse.index');
    Route::post('warehouse', [WarhouseCotroller::class, 'store'])->name('warhouse.store');
    Route::get('/warehouse/{warehouse}/edit', [WarhouseCotroller::class, 'edit'])->name('warehouse.edit');
    Route::delete('/warehouse/{warehouse}/delete', [WarhouseCotroller::class, 'destory'])->name('warehouse.destory');
});


Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
