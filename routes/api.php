<?php

use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StateAdvisoryController;
use App\Http\Controllers\API\CareersController;
use App\Http\Controllers\API\StartupController;
use App\Http\Controllers\API\PetitionsController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\OtherercsController;
use App\Http\Controllers\API\OtherlinksController;
use App\Http\Controllers\API\AdviceGOKController;
use App\Http\Controllers\API\RulesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

//careers
Route::get('careers', [CareersController::class, 'index']);

Route::post('careers', [CareersController::class, 'store']);

// Retrieve a specific career opportunity
Route::get('careers/{id}', [CareersController::class, 'show']);

// Update a career opportunity
Route::put('careers/{id}', [CareersController::class, 'update']);

// Delete a career opportunity
Route::delete('careers/{id}', [CareersController::class, 'destroy']);

Route::get('storage/careers/{filename}', function ($filename) {
    $path = storage_path('app/careers/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('career-pdf');


//State Advisory Committe
Route::get('stateadvisory', [StateAdvisoryController::class, 'index']);

// Create a new state advisory commette
Route::post('stateadvisory', [StateAdvisoryController::class, 'store']);


// Retrieve a state advisory commette
Route::get('stateadvisory/{id}', [StateAdvisoryController::class, 'show']);

// Update a state advisory commette
Route::put('stateadvisory/{id}', [StateAdvisoryController::class, 'update']);

// Delete a state advisory commette
Route::delete('stateadvisory/{id}', [StateAdvisoryController::class, 'destroy']);


//Startup Enterprises
Route::post('startup', [StartupController::class, 'store']);

// Retrieve a specific Petitions
Route::get('startup/{id}', [StartupController::class, 'show']);

// Update a Petitions
Route::put('startup/{id}', [StartupController::class, 'update']);

// Delete a Petitions
Route::delete('startup/{id}', [StartupController::class, 'destroy']);

Route::get('storage/startup/{filename}', function ($filename) {
    $path = storage_path('app/startup/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('startup-pdf');

//petitions
Route::post('petitions', [PetitionsController::class, 'store']);

// Retrieve a specific Petitions
Route::get('petitions/{id}', [PetitionsController::class, 'show']);

// Update a Petitions
Route::put('petitions/{id}', [PetitionsController::class, 'update']);

// Delete a Petitions
Route::delete('petitions/{id}', [PetitionsController::class, 'destroy']);

Route::get('storage/petitions/{filename}', function ($filename) {
    $path = storage_path('app/petitions/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('petitions-pdf');


//events

Route::get('events', [EventsController::class, 'index']);

// Create a new Events
Route::post('events', [EventsController::class, 'store']);

// Retrieve a specific Events
Route::get('events/{id}', [EventsController::class, 'show']);

// Update a Events
Route::put('events/{id}', [EventsController::class, 'update']);

// Delete a career opportunity
Route::delete('events/{id}', [EventsController::class, 'destroy']);

Route::get('storage/events/{filename}', function ($filename) {
    $path = storage_path('app/events/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*\.(jpeg|jpg|png)');

//OtherERCS
Route::get('other_ercs', [OtherercsController::class, 'index']);

// Create a new OtherERCS
Route::post('other_ercs', [OtherercsController::class, 'store']);


// Retrieve a OtherERCS
Route::get('other_ercs/{id}', [OtherercsController::class, 'show']);

// Update a OtherERCS
Route::put('other_ercs/{id}', [OtherercsController::class, 'update']);

// Delete a OtherERCS
Route::delete('other_ercs/{id}', [OtherercsController::class, 'destroy']);

//Otherlinks

Route::get('other_links', [OtherlinksController::class, 'index']);

// Create a new Otherlinks
Route::post('other_links', [OtherlinksController::class, 'store']);

// Retrieve a Otherlinks
Route::get('other_links/{id}', [OtherlinksController::class, 'show']);

// Update a Otherlinks
Route::put('other_links/{id}', [OtherlinksController::class, 'update']);

// Delete a Otherlinks
Route::delete('other_links/{id}', [OtherlinksController::class, 'destroy']);

Route::get('storage/logo/{filename}', function ($filename) {
    $path = storage_path('app/logo/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*\.(jpeg|jpg|png)');

//Avice to GOK

Route::get('advice_to_gok', [AdviceGOKController::class, 'index']);

// Create a new Avice to GOK
Route::post('advice_to_gok', [AdviceGOKController::class, 'store']);

// Retrieve a Avice to GOK
Route::get('advice_to_gok/{id}', [AdviceGOKController::class, 'show']);

// Update a Avice to GOK
Route::put('advice_to_gok/{id}', [AdviceGOKController::class, 'update']);

// Delete a Avice to GOK
Route::delete('advice_to_gok/{id}', [AdviceGOKController::class, 'destroy']);

Route::get('storage/adviceGOK/{filename}', function ($filename) {
    $path = storage_path('app/adviceGOK/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*\.(pdf)');

//Rules

Route::get('rules', [RulesController::class, 'index']);

// Create a new Rules
Route::post('rules', [RulesController::class, 'store']);

// Retrieve a Rules
Route::get('rules/{id}', [RulesController::class, 'show']);

// Update a Rules
Route::put('rules/{id}', [RulesController::class, 'update']);

// Delete a Rules
Route::delete('rules/{id}', [RulesController::class, 'destroy']);

Route::get('storage/rules/{filename}', function ($filename) {
    $path = storage_path('app/rules/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*\.(pdf)');

