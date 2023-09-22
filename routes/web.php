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
    PageController,
    ProductController,
    ProfileController,
    SeoController,
    SmtpController,
    SubcategoryController,
    WarhouseCotroller
};
use App\Http\Controllers\Frontend\{
    IndexpageController
};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Route
 */
Route::get('/',[IndexpageController::class,'index'])->name('website.home');


/**
 * SUPPER ADMIN ALL ROUTE
 */
Route::prefix('admin/')->middleware('superAdmin', 'verified')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin.index');
    //category all route
    Route::resource('category', CategoryController::class);
    Route::get('pagination/paginate-data', [CategoryController::class, 'pagination']);
    Route::get('category/search', [CategoryController::class, 'search'])->name('category.search');

    Route::resource('sub-category', SubcategoryController::class);
    Route::resource('child-category', ChilCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('page', PageController::class);
    /**
     *  Product Routes
     */
    Route::resource('product', ProductController::class);
    //GET Attribute value form product  controller
    Route::get('attribute-value/{id}', [ProductController::class, 'getAttributeValue'])->name('attribute.value');

    Route::resource('color', ColorController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('attribute-value', AttributeValueController::class);
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

    //Profile Routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 *  *Email Verification
 */
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/admin');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Resent Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
