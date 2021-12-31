<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ArgumentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RenderPipelineController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('projects', ProjectController::class);
        Route::resource('commands', CommandController::class);
        Route::resource('arguments', ArgumentController::class);
        Route::resource('render-pipelines', RenderPipelineController::class);
        Route::resource('pages', PageController::class);
        Route::resource('sections', SectionController::class);
    });
