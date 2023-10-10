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
    GeneralSettingController,
    PageController,
    ProductAllStatusUpdate,
    ProductController,
    ProfileController,
    SeoController,
    SmtpController,
    SubcategoryController,
    WarhouseCotroller
};
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Frontend\{
    IndexpageController,
    ReviewController,
    ShopController
};
use App\Http\Controllers\CartController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Controllers\Customer\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Route
 */
Route::prefix('/')->group(function () {
    Route::get('', [IndexpageController::class, 'index'])->name('website.home');
    Route::get('details/{slug}', [IndexpageController::class, 'details'])->name('product.details');
    Route::middleware('customer','verified')->group(function () {
        // Product Review
        Route::post('review/product', [ReviewController::class, 'store'])->name('store.review');
        //customer profile page route
        Route::get('profile', [LoginController::class, 'customerProfile'])->name('customer.profile');
                //Cart view
                Route::get('cart', [CartController::class, 'viewcart'])->name('view.cart');
        //store cart item
        Route::post('add-to-cart-quick-view', [CartController::class, 'addCartQuickView'])->name('add.cart.item');
        //remove cart item
        Route::get('remove-cart-item/{productId}', [CartController::class, 'removeCartItem'])->name('remove.cart.item');
    });
    //Add To Cart
    Route::get('quick-view/{id}', [CartController::class, 'cartInfo'])->name('cart.info');

    //Customer Login & Registration
    Route::get('customer/account/create', [RegisterController::class, 'register'])->name('customer.account.create');
    Route::get('customer/account/login', [LoginController::class, 'login'])->name('customer.account.login');
    //Category wise Product display
    Route::get('shop/{category}', [ShopController::class, 'categoryProduct'])->name('category.product');
    //Search Product
    Route::get('/products/search',[IndexpageController::class,'productSearch'])->name('products.search');

});

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
    //childcategory route
    Route::resource('child-category', ChilCategoryController::class);
    Route::get('selected/subcategory/onchildcategory/{id}', [ChilCategoryController::class, 'getSelectedSubcategory'])->name('childcategory.selected.subcategory');

    Route::resource('brand', BrandController::class);
    Route::resource('page', PageController::class);
    /**
     *  Product Routes
     */
    Route::resource('product', ProductController::class);
    //GET Attribute value form product  controller
    Route::get('attribute-value/{id}', [ProductController::class, 'getAttributeValue'])->name('attribute.value');
    Route::get('selected/subcategory{id}', [ProductController::class, 'getSelectedSubcategory'])->name('selected.subcategory');
    Route::get('selected/childcategory/{id}', [ProductController::class, 'getSelectedChildcategory'])->name('selected.childcategory');
    /**
     * Product Active Status Update Route
     */
    Route::get('product/deactive/{id}', [ProductAllStatusUpdate::class, 'productDeactive'])
        ->name('product.deactive');

    Route::get('product/active/{id}', [ProductAllStatusUpdate::class, 'productAactive'])
        ->name('product.active');
    /**
     * Featured Product Active Status Update Route
     */
    Route::get('featured/active/{id}', [ProductAllStatusUpdate::class, 'featuredActive'])
        ->name('featured.active');

    Route::get('featured/deactive/{id}', [ProductAllStatusUpdate::class, 'featuredDactive'])
        ->name('featured.deactive');
    /**
     * Todays_Deal_Active Product Active Status Update Route
     */
    Route::get('todays_deal_active/active/{id}', [ProductAllStatusUpdate::class, 'todaysDealActive'])
        ->name('todays_deal_active.active');

    Route::get('todays_deal_active/deactive/{id}', [ProductAllStatusUpdate::class, 'todaysDealDctive'])
        ->name('todays_deal_active.deactive');

    /**
     * Trandy Product Active Status Update Route
     */
    Route::get('trandy/active/{id}', [ProductAllStatusUpdate::class, 'trandyActive'])
        ->name('trandy.active');

    Route::get('trandy/deactive/{id}', [ProductAllStatusUpdate::class, 'trandyDctive'])
        ->name('trandy.dactive');

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

    //General setting route
    Route::get('general-setting', [GeneralSettingController::class, 'index'])->name('generalsetting.index');
    Route::post('general-setting', [GeneralSettingController::class, 'store'])->name('generalsetting.store');
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
