<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(['middleware' => ['auth','verified'] , 'as'=>'dashboard.' , 'prefix' => 'dashboard'],function(){


    Route::get('/',[DashboardController::class,'index'])->name('dashboard');


    Route::get('/categories/trash',[CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class, 'restore'])->name('categories.restore');

    Route::resource('/categories', CategoriesController::class);
    Route::delete('/categories/{category}/forece-delete',[CategoriesController::class, 'foreceDelete'])->name('categories.force-delete');

});


