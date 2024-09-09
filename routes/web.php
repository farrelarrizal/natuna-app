<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\HankamController;
use App\Http\Controllers\MarineResourceController;
use App\Http\Controllers\ApiDataController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\FormsController;


Route::get('/', function () {
    # if not authenticated, redirect to login page
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard.executive-summary');
});

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// protected by auth middleware
Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('peta-geografi', [PetaController::class, 'geografi'])->name('peta-geografi');
    Route::get('peta-keamanan', [PetaController::class, 'keamanan'])->name('peta-keamanan');

    Route::prefix('summary')->name('summary.')->group(function () {
        Route::get('defence-security', [HankamController::class, 'summary'])->name('hankam');
        Route::get('defence-infrastructure', [HankamController::class, 'infraSummary'])->name('infra-hankam');
        Route::get('marine-resource', [MarineResourceController::class, 'summary'])->name('marine-resource');
    });

    Route::prefix('hankam')->name('hankam.')->group(function () {
        Route::get('details', [HankamController::class, 'details'])->name('details');
        // Route::get('maps', [HankamController::class, 'maps'])->name('maps');
        Route::get('simulation', [HankamController::class, 'simulation'])->name('simulation');

        Route::prefix('threats')->name('threats.')->group(function () {
            Route::get('military', [HankamController::class, 'threatsMilitary'])->name('military');
            Route::get('non-military',  [HankamController::class, 'threatsNonMilitary'])->name('non-military');
            Route::get('hybrid-military',  [HankamController::class, 'threatsHybridMilitary'])->name('hybrid-military');
        });
        Route::prefix('simulation')->name('simulation.')->group(function () {
            Route::prefix('base-model')->name('base-model.')->group(function () {
                Route::get('/', [HankamController::class, 'simulationBaseModel'])->name('index');
                Route::get('edit-parameter', [HankamController::class, 'editParameterBaseModel'])->name('edit-parameter');
                Route::put('update-variable', [HankamController::class, 'updateVariableBaseModel'])->name('update-variable');
                Route::get('upload-model', [HankamController::class, 'uploadModelBaseModel'])->name('upload-model');
                Route::post('uploadModel', [HankamController::class, 'uploadModel'])->name('uploadModel');
                Route::post('upload-sfd', [HankamController::class, 'uploadSfdImage'])->name('upload-sfd');
                Route::post('upload-cld', [HankamController::class, 'uploadCldImage'])->name('upload-cld');
                Route::get('get-sfd-variables/{sfdId}', [HankamController::class, 'getSfdVariables']);

                // Route::get('get-variables', [HankamController::class, 'getVariablesBySFD'])->name('get-variables');
            });
            Route::prefix('scenario-model')->name('scenario-model.')->group(function () {
                Route::get('/',  [HankamController::class, 'simulationScenarioModel'])->name('index');
                Route::get('createScenario', [HankamController::class, 'createScenario'])->name('createScenario');
                Route::post('storeScenario', [HankamController::class, 'storeScenario'])->name('storeScenario');
                Route::get('detail/{id}',  [HankamController::class, 'detailScenarioModel'])->name('detail');
                Route::get('edit-variable/{id}', [HankamController::class, 'editVariableScenarioModel'])->name('edit-variable');
                Route::put('update-variables/{id}', [HankamController::class, 'updateVariableScenarioModel'])->name('update-variables');
            });

            Route::prefix('outcome-scenario')->name('outcome-scenario.')->group(function () {
                Route::get('/', [HankamController::class, 'simulationOutcomeScenario'])->name('index');
                Route::get('createOutcome/{id}', [HankamController::class, 'createOutcome'])->name('createOutcome');
                Route::post('storeOutcome', [HankamController::class, 'storeOutcome'])->name('storeOutcome');
                Route::get('detail/{id}', [HankamController::class, 'detailOutcomeScenario'])->name('detail');
            });
        });
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('executive-summary', [DashboardController::class, 'executiveSummary'])->name('executive-summary');
        Route::get('recommendation',  [DashboardController::class, 'recommendation'])->name('recommendation');
        Route::get('maps', [DashboardController::class, 'maps'])->name('maps');
        Route::get('policy-brief', [DashboardController::class, 'policyBrief'])->name('policy-brief');
    });

    // forms
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('', [FormsController::class, 'index'])->name('index');
        Route::get('create', [FormsController::class, 'create'])->name('create');
        Route::post('store', [FormsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [FormsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [FormsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [FormsController::class, 'delete'])->name('delete');
        Route::get('show/{id}', [FormsController::class, 'show'])->name('show');
        Route::get('view/{id}', [FormsController::class, 'showForm'])->name('showForm');
        Route::post('storeAnswer', [FormsController::class, 'storeAnswer'])->name('storeAnswer');
    });



    Route::prefix('tools')->name('tools.')->group(function () {
        // Route for the index method
        Route::get('key-variable', [ToolsController::class, 'index'])->name('key-variable.index');

        // Route for the update method
        Route::get('key-variable/{variable}/edit', [ToolsController::class, 'edit'])->name('key-variable.edit');
        Route::put('key-variable/{variable}', [ToolsController::class, 'update'])->name('key-variable.update');

        // Route for recommendation
        Route::prefix('recommendation')->name('recommendation.')->group(function () {
            Route::get('/', [ToolsController::class, 'recommendation'])->name('index');
            Route::get('create', [ToolsController::class, 'createRecommendation'])->name('create');
            Route::post('store', [ToolsController::class, 'storeRecommendation'])->name('store');
            Route::get('edit/{id}', [ToolsController::class, 'editRecommendation'])->name('edit');
            Route::put('update/{id}', [ToolsController::class, 'updateRecommendation'])->name('update');
            Route::delete('delete/{id}', [ToolsController::class, 'deleteRecommendation'])->name('delete');
            Route::get('show/{id}', [ToolsController::class, 'showRecommendation'])->name('show');
        });
    });

    Route::prefix('marine-resource')->name('marine-resource.')->group(function () {
        Route::get('/', [MarineResourceController::class, 'index']);
    });

    //API Data 
    Route::prefix('api')->name('api.')->group(function () {
        //data
        Route::get('/get-variables', [ApiDataController::class, 'getVariables'])->name('get.variables');
        Route::get('/get-variables-active', [ApiDataController::class, 'getKeyVariableActive'])->name('get.variables.keyactive');
        Route::get('/get-sfd', [ApiDataController::class, 'getSfd'])->name('get-sfd');
        Route::get('/sfd-image/{id}', [ApiDataController::class, 'getSfdImagePath']);

        Route::get('/search-variables', [ApiDataController::class, 'searchVariables'])->name('search.variable');
        Route::get('/search-sfd', [ApiDataController::class, 'searchSFD'])->name('search.sfd');
        //graph

        Route::get('/base-model-graph-data', [ApiDataController::class, 'baseModelGraph'])->name('base-model.graph');
        Route::get('/scenario-graph-data', [ApiDataController::class, 'variabelActiveGraph'])->name('scenario.graph');
        Route::get('/scenario-model/download/{id}', [ApiDataController::class, 'downloadScenarioModel'])->name('scenario-model.download');
    });
});
