<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Backend\Auth\LoginController;
    use App\Http\Controllers\Backend\AdminController;
    use App\Http\Controllers\Backend\AjaxController;
    use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
    use App\Http\Controllers\Backend\Auth\ResetPasswordController;
    use App\Http\Controllers\Backend\Auth\ConfirmPasswordController;
    use App\Http\Controllers\Backend\BrandController;
    use App\Http\Controllers\Backend\CategoryController;
    use App\Http\Controllers\Backend\PermissionController;
    use App\Http\Controllers\Backend\ProductController;
    use App\Http\Controllers\Backend\ProfileController;
    use App\Http\Controllers\Backend\RolesController;
    use App\Http\Controllers\Backend\SliderController;
    use App\Http\Controllers\Backend\SubCategoryController;
    use App\Http\Controllers\Backend\SubSubCategoryController;
    use App\Http\Controllers\Backend\UserController;
    use App\Http\Controllers\Backend\CouponController;
    use App\Http\Controllers\Backend\ShippingAreaController;

Route::get('/', function () {
        return redirect()->route('admin.login.get');
    });

    Route::get('login',[LoginController::class,'adminLoginForm'])->name('admin.login.get');
    Route::post('logins',[LoginController::class,'login'])->name('admin.login');

    Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('admin.password.update');

    Route::get('password/confirm', [ConfirmPasswordController::class,'showConfirmForm'])->name('admin.password.confirm.get');
    Route::post('password/confirm', [ConfirmPasswordController::class,'confirm'])->name('admin.password.confirm');


    Route::middleware('auth:admin')->group(function(){

        //Admin Dashboard Route
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');

        //Admin Logout Route
        Route::post('logout',[LoginController::class,'logout'])->name('admin.logout');

        // Roles Route Resource
        Route::resource('roles', RolesController::class,['names'=>'admin.roles'])->except([ 'show']);

        // Permission Routes
        Route::get('permissions',[PermissionController::class,'index'])->name('admin.permission.create');
        Route::post('permissions/store',[PermissionController::class,'store'])->name('admin.permission.store');


        // Admin User Routes
        Route::resource('user', UserController::class,['names'=> 'admin.user'])->except([ 'show']);

        //Admin User Routes
        Route::get('profile', [ProfileController::class,'index'])->name('admin.profile.index');
        Route::get('profile/edit', [ProfileController::class,'edit'])->name('admin.profile.edit');
        Route::put('profile/update/{id}', [ProfileController::class,'update'])->name('admin.profile.update');
        Route::put('profile/change/password/{id}', [ProfileController::class,'change_password'])->name('admin.profile.change.password');

        //Brand Routes
        Route::prefix('brands')->group(function(){
            Route::get('/',[BrandController::class,'Brand_Index'])->name('admin.brand.index');
            Route::post('/store',[BrandController::class,'Brand_Store'])->name('admin.brand.store');
            Route::get('/edit/{id}',[BrandController::class,'Brand_Edit'])->name('admin.brand.edit');
            Route::put('/update/{id}',[BrandController::class,'Brand_Update'])->name('admin.brand.update');
            Route::delete('/destroy/{id}',[BrandController::class,'Brand_Destroy'])->name('admin.brand.destroy');
        });

        Route::prefix('category')->group(function(){
        //Category Routes
        Route::resource('/category', CategoryController::class,['names' => 'admin.category'])->except(['create', 'show']);

        //Sub Category Routes
        Route::resource('/sub', SubCategoryController::class,['names' => 'admin.subcategory'])->except(['create','show']);
        Route::get('/sub/ajax/{id}',[AjaxController::class,'Sub_Ajax'])->name('admin.subcategory.ajax');

        //Sub Sub Category Routes
        Route::resource('/sub/sub', SubSubCategoryController::class,['names' => 'admin.subsubcategory'])->except(['create','show']);
        Route::get('/sub/sub/ajax/{id}',[AjaxController::class,'SubSub_Ajax'])->name('admin.subsubcategory.ajax');

        });

        //Product Routes
        Route::resource('/product', ProductController::class,['names' => 'admin.product'])->except(['show']);
        Route::post('/product/multiimg/',[ProductController::class,'multiimgupdate'])->name('admin.product.multiimg');
        Route::put('/product/thambnail/{id}',[ProductController::class,'thambnailupdate'])->name('admin.product.thambnail');
        Route::get('/product/inactive/{id}',[ProductController::class,'product_inactive'])->name('admin.product.inactive');
        Route::get('/product/active/{id}',[ProductController::class,'product_active'])->name('admin.product.active');

        // Slider Routes
        Route::resource('/slider', SliderController::class,['names' => 'admin.slider'])->except(['create','show']);
        Route::get('/slider/inactive/{id}',[SliderController::class,'slider_inactive'])->name('admin.slider.inactive');
        Route::get('/slider/active/{id}',[SliderController::class,'slider_active'])->name('admin.slider.active');

        //Coupons Routes
        Route::resource('/coupon', CouponController::class,['names' => 'admin.coupon'])->except(['create', 'show']);


        //shipping division Routes
        Route::resource('/shipping', ShippingAreaController::class,['names' => 'admin.shipping'])->except(['create', 'show']);

        //Shiping District Routes
        Route::prefix('shipping/district')->group(function(){
        Route::get('/',[ShippingAreaController::class,'district_Index'])->name('admin.shipping.district.index');
        Route::post('/store',[ShippingAreaController::class,'district_Store'])->name('admin.shipping.district.store');
        Route::get('/edit/{id}',[ShippingAreaController::class,'district_Edit'])->name('admin.shipping.district.edit');
        Route::put('/update/{id}',[ShippingAreaController::class,'district_Update'])->name('admin.shipping.district.update');
        Route::delete('/destroy/{id}',[ShippingAreaController::class,'district_Destroy'])->name('admin.shipping.district.destroy');

        //Shiping District Routes
        Route::prefix('shipping/state')->group(function(){
        Route::get('/',[ShippingAreaController::class,'State_Index'])->name('admin.shipping.state.index');
        Route::post('/store',[ShippingAreaController::class,'State_Store'])->name('admin.shipping.state.store');
        Route::get('/edit/{id}',[ShippingAreaController::class,'State_Edit'])->name('admin.shipping.state.edit');
        Route::put('/update/{id}',[ShippingAreaController::class,'State_Update'])->name('admin.shipping.state.update');
        Route::delete('/destroy/{id}',[ShippingAreaController::class,'State_Destroy'])->name('admin.shipping.state.destroy');
    });






});




    });



