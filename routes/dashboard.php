<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;

Route::group(['middleware' => ['auth','verified'] , 'as'=>'dashboard.' , 'prefix' => 'dashboard'],function(){


    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');


    Route::get('/categories/trash',[CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class, 'restore'])->name('categories.restore');

    Route::resource('/categories', CategoriesController::class);
    Route::delete('/categories/{category}/force-delete',[CategoriesController::class, 'forceDelete'])->name('categories.force-delete');


    Route::resource('/products', ProductController::class);
});


