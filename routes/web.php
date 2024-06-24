<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\LandingController;

// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('landing.index');
// })->name('landing.index');

Route::get('/', [LandingController::class, 'index'])->name('landing.index');

Route::get('about', function () {
    return view('landing.about');
})->name('landing.about');

// Route::get('package', function () {
//     return view('landing.package');
// })->name('landing.package');

// Route::get('package/detail', function () {
//     return view('landing.package-detail');
// })->name('landing.package');

// Route::get('contact', function () {
//     return view('landing.contact');
// })->name('landing.contact');
Route::get('contact', [LandingController::class, 'contact'])->name('landing.contact');



// Route::get('post/{url}', function () {
//     return view('articles.post');
// })->name('landing.post');

// Route::get('articles', function () {
//     return view('articles.articles');
// })->name('landing.articles');

// Route::get('articles/post-{id}', function ($id) {
//     return view('articles.blog');
// })->name('landing.articles.post');

Route::prefix('article')->name('articles.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('{url}', [ArtikelController::class, 'show'])->name('show');
});

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// Route::prefix('paket')->name('paket.')->group(function () {
//     Route::get('/', [PaketController::class, 'index'])->name('index');
// });

// Route::prefix('artikel')->name('artikel.')->group(function () {
//     Route::get('/', [ArtikelController::class, 'admin'])->name('index');
// });

Route::prefix('package')->name('package.')->group(function () {
    Route::get('/', [PackageController::class, 'index'])->name('index');
    Route::get('{url}', [PackageController::class, 'show'])->name('show');
});
// protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('artikel', [ArtikelController::class, 'admin'])->name('artikel');
    });




    //     // dashboard
    //     Route::get('peta-geografi', [PetaController::class, 'geografi'])->name('peta-geografi');
    //     Route::get('peta-keamanan', [PetaController::class, 'keamanan'])->name('peta-keamanan');

    //     Route::prefix('hankam')->name('hankam.')->group(function () {
    //         Route::get('summary', [HankamController::class, 'summary'])->name('summary');
    //         Route::get('details', [HankamController::class, 'details'])->name('details');
    //         Route::get('maps', [HankamController::class, 'maps'])->name('maps');
    //         Route::get('simulation', [HankamController::class, 'simulation'])->name('simulation');

    //         Route::prefix('threats')->name('threats.')->group(function () {
    //             Route::get('military', [HankamController::class, 'threatsMilitary'])->name('military');
    //             Route::get('non-military',  [HankamController::class, 'threatsNonMilitary'])->name('non-military');
    //             Route::get('hybrid-military',  [HankamController::class, 'threatsHybridMilitary'])->name('hybrid-military');
    //         });
    //         Route::prefix('simulation')->name('simulation.')->group(function () {
    //             Route::prefix('base-model')->name('base-model.')->group(function () {
    //                 Route::get('/', [HankamController::class, 'simulationBaseModel'])->name('index');
    //                 Route::get('edit-parameter', [HankamController::class, 'editParameterBaseModel'])->name('edit-parameter');
    //             });
    //             Route::prefix('scenario-model')->name('scenario-model.')->group(function () {
    //                 Route::get('/',  [HankamController::class, 'simulationScenarioModel'])->name('index');
    //                 Route::get('detail',  [HankamController::class, 'detailScenarioModel'])->name('detail');
    //             });
    //             Route::prefix('outcome-scenario')->name('outcome-scenario.')->group(function () {
    //                 Route::get('/',  [HankamController::class, 'simulationOutcomeScenario'])->name('index');
    //                 Route::get('detail',  [HankamController::class, 'detailOutcomeScenario'])->name('detail');
    //             });
    //         });
    //     });

    //     Route::prefix('dashboard')->name('dashboard.')->group(function () {
    //         Route::get('/', [DashboardController::class, 'index']);
    //         Route::get('executive-summary', [DashboardController::class, 'executiveSummary'])->name('executive-summary');
    //         Route::get('recommendation',  [DashboardController::class, 'recommendation'])->name('recommendation');
    //     });

    //     Route::prefix('marine-resource')->name('marine-resource.')->group(function () {
    //         Route::get('/', [MarineResourceController::class, 'index']);
    // });
});
