<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\HankamController;
use App\Http\Controllers\MarineResourceController;

Route::get('/', function () {
    $data = [
        'title' => 'Selamat Lebaran',
    ];
    return view('comingsoon', $data);
});

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// protected by auth middleware
Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('peta-geografi', [PetaController::class, 'geografi'])->name('peta-geografi');
    Route::get('peta-keamanan', [PetaController::class, 'keamanan'])->name('peta-keamanan');

    Route::prefix('hankam')->name('hankam.')->group(function () {
        Route::get('summary', [HankamController::class, 'summary'])->name('summary');
        Route::get('details', [HankamController::class, 'details'])->name('details');
        Route::get('maps', [HankamController::class, 'maps'])->name('maps');
        Route::get('simulation', [HankamController::class, 'simulation'])->name('simulation');

        Route::prefix('threats')->name('threats.')->group(function () {
            Route::get('military', [HankamController::class, 'threatsMilitary'])->name('military');
            Route::get('non-military',  [HankamController::class, 'threatsNonMilitary'])->name('non-military');
            Route::get('hybrid-military',  [HankamController::class, 'threatsHybridMilitary'])->name('hybrid-military');
        });
        Route::prefix('simulation')->name('simulation.')->group(function () {
            Route::prefix('base-model')->name('base-model.')->group(function (){
                Route::get('/', [HankamController::class, 'simulationBaseModel'])->name('index');
                Route::get('edit-parameter', [HankamController::class, 'editParameterBaseModel'])->name('edit-parameter');
            });
            Route::prefix('scenario-model')->name('scenario-model.')->group(function (){
                Route::get('/',  [HankamController::class, 'simulationScenarioModel'])->name('index');
                Route::get('detail',  [HankamController::class, 'detailScenarioModel'])->name('detail');
            });
            Route::prefix('outcome-scenario')->name('outcome-scenario.')->group(function (){
                Route::get('/',  [HankamController::class, 'simulationOutcomeScenario'])->name('index');
                Route::get('detail',  [HankamController::class, 'detailOutcomeScenario'])->name('detail');
            });
           
        });
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('executive-summary', [DashboardController::class, 'executiveSummary'])->name('executive-summary');
        Route::get('recommendation',  [DashboardController::class, 'recommendation'])->name('recommendation');
    });

    Route::prefix('marine-resource')->name('marine-resource.')->group(function () {
        Route::get('/', [MarineResourceController::class, 'index']);
    });

});

