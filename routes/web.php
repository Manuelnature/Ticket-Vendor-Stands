<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VendingPointController;


Route::group(['middleware' => 'disable_back_button'], function () {

    Route::get('/', [LoginController::class, 'index'])->middleware('alreadyLoggedIn');
    Route::post('login', [LoginController::class, 'login_user'])->name('login');

    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register_user', [RegisterController::class, 'register'])->name('register_user');


    Route::group(['middleware' => 'isLoggedIn'], function () {

        Route::get('vendor_page', [VendorController::class, 'index']);
        Route::get('vending_point', [VendorController::class, 'vending_point']);
        Route::post('add_vending_point', [VendorController::class, 'add_vending_point'])->name('add_vending_point');

        Route::get('vendor_sales/{id}', [VendorController::class, 'vendor_sales']);
        Route::post('add_sales', [VendorController::class, 'add_sales'])->name('add_sales');

        Route::get('tickets', [TicketController::class, 'index']);

        Route::get('organizer', [OrganizerController::class, 'index']);
        Route::get('organizer_details/{event_id}', [OrganizerController::class, 'organizer_details']);


        Route::get('add_organizer', [OrganizerController::class, 'add_organizer']);
        Route::post('add_new_organizer', [OrganizerController::class, 'add_new_organizer'])->name('add_new_organizer');



        Route::get('add_event', [EventController::class, 'index']);
        Route::post('add_new_event', [EventController::class, 'add_event'])->name('add_new_event');

        Route::get('assign_event/{vending_point_id}', [EventController::class, 'assign_event']);

        Route::post('assign_new_event', [EventController::class, 'assign_new_event'])->name('assign_new_event');


        Route::get('vending_point_details/{vending_point_id}/{event_id}', [VendingPointController::class, 'vending_point_details']);

        Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

        // LOGOUT ======================
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    });

});


// Route::get('/', [HomeController::class, 'index']);



