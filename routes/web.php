<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\RawProductController;
use App\Http\Controllers\admin\RawProductSizeController;

Route::controller(AuthController::class)->group(function (){
    Route::get('/sign-in','signInPage')->name('admin.sign-in');
    Route::post('/sign-in','signIn')->name('sign-in');
    Route::get('/sign-up','signUpPage')->name('admin.sign-up');
    Route::get('/log-out','logOut')->name('admin.log-out');
});

Route::prefix('admin')->middleware('auth')->group(function (){

    Route::controller(DashboardController::class)->group(function (){
        Route::get('/dashboard','index')->name('admin.dashboard');
    });

    Route::prefix('user')-> controller(UserController::class)->group(function (){
        Route::get('/user-list','index')->name('admin.user.list');
        Route::get('/user-details/{id}','userInfo')->name('admin.user.details');
        Route::post('/user-update-details','updateUserInfo')->name('admin.update.user.details');
        Route::get('/delete-user/{id}','deleteUser')->name('admin.delete.user');
        Route::get('/create-user','createUser')->name('admin.create.user');
        Route::post('/create-user','storeUser')->name('admin.store.user');
    });
    Route::prefix('acl')-> controller(RolePermissionController::class)->group(function (){
        Route::get('/role-list','role')->name('admin.role.list');
        Route::get('/permission-list','permission')->name('admin.permission.list');
        Route::get('/role-permission','index')->name('admin.role-permission');
        Route::get('/role-permission-details/{id}','rolePermissionDetails')->name('admin.role-permission.details');
        Route::get('/role-details/{id}','getRoleDetails')->name('admin.role.details');
        Route::post('/role-permission-update','updateRolePermission')->name('admin.update.role.permission');
        Route::post('/update-role-permission-details/{id}','updateRolePermissionDetails')->name('admin.update.role-permission');
        Route::get('/delete-permission/{id}','deletePermission')->name('admin.delete.permission');
    });

    Route::prefix('raw-product')-> controller(RawProductController::class)->group(function (){
        Route::get('/create-product','createProduct')->name('admin.create.product');
        Route::post('/create-product','storeProduct')->name('admin.store.product');
        Route::post('/update-product/{slug}','updateProduct')->name('admin.update.product');
        Route::get('/product-list','productList')->name('admin.product.list');
        Route::get('/product-details/{slug}','productDetails')->name('admin.product.details');
        Route::get('/product-delete/{slug}','deleteProduct')->name('admin.product.delete');
    });

    Route::prefix('product-size')-> controller(RawProductSizeController::class)->group(function (){
        Route::get('/create-product-size','createProduct')->name('admin.create.product.size');
        Route::get('/update-raw-product-size/{id}','updateProduct')->name('admin.update.product.size');
        Route::get('/delete-raw-product-size/{id}','deleteProduct')->name('admin.delete.product.size');
        Route::post('/update-raw-product-size/{id}','updateRawProductSize')->name('admin.update.raw.product.size');
        Route::post('/store-product-size','storeProductSize')->name('admin.store.product.size');
    });
});
