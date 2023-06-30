<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LandLord\ClienteController;
use App\Http\Controllers\LandLord\WelcomeController;

Route::get('/', function () {
   return redirect()->route("landlord.welcome");
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function(){
    Route::get("dashboard",[WelcomeController::class,'index'])->name("landlord.welcome");

    Route::group(["prefix"=>"cliente"],function(){
        Route::get("index",[ClienteController::class,'index'])->name("landlord.cliente.index");
        Route::get("create",[ClienteController::class,'create'])->name("landlord.cliente.create");
        Route::get("{id}/edit",[ClienteController::class,'edit'])->name("landlord.cliente.edit");
        Route::post("store",[ClienteController::class,'store'])->name("landlord.cliente.store");
    });
    Route::get("landlord/ruc/{ruc}",[ApiController::class,'apiRuc'])->name('apiRuc');
    Route::get("landlord/dni/{dni}",[ApiController::class,'apiDni'])->name('apiDni');
});