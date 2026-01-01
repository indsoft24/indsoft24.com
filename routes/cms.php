<?php

use App\Http\Controllers\CmsController;
use Illuminate\Support\Facades\Route;

// --- CMS Public Routes ---
Route::prefix('cms')->name('cms.')->group(function () {
    Route::get('/states', [CmsController::class, 'states'])->name('states');
    Route::get('/state/{state}', [CmsController::class, 'statePages'])->name('state.pages');
    Route::get('/state/{state}/cities', [CmsController::class, 'stateCities'])->name('state.cities');
    Route::get('/city/{city}', [CmsController::class, 'cityPages'])->name('city.pages');
    Route::get('/city/{city}/areas', [CmsController::class, 'cityAreas'])->name('city.areas');
    Route::get('/area/{area}', [CmsController::class, 'areaPages'])->name('area.pages');
    Route::get('/page/{page}', [CmsController::class, 'showPage'])->name('page');
    Route::get('/search', [CmsController::class, 'search'])->name('search');
});

