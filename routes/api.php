<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CommandController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\ArgumentController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PageSectionsController;
use App\Http\Controllers\Api\SectionPagesController;
use App\Http\Controllers\Api\ProjectOptionController;
use App\Http\Controllers\Api\RenderPipelineController;
use App\Http\Controllers\Api\SectionSectionsController;
use App\Http\Controllers\Api\CommandArgumentsController;
use App\Http\Controllers\Api\ProjectProjectOptionsController;
use App\Http\Controllers\Api\ProjectRenderPipelinesController;
use App\Http\Controllers\Api\CommandRenderPipelinesController;
use App\Http\Controllers\Api\RenderPipelineCommandsController;
use App\Http\Controllers\Api\RenderPipelineProjectsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('projects', ProjectController::class);

        // Project Options
        Route::get('/projects/{project}/project-options', [
            ProjectProjectOptionsController::class,
            'index',
        ])->name('projects.project-options.index');
        Route::post('/projects/{project}/project-options', [
            ProjectProjectOptionsController::class,
            'store',
        ])->name('projects.project-options.store');

        // Project Render Pipelines
        Route::get('/projects/{project}/render-pipelines', [
            ProjectRenderPipelinesController::class,
            'index',
        ])->name('projects.render-pipelines.index');
        Route::post('/projects/{project}/render-pipelines/{renderPipeline}', [
            ProjectRenderPipelinesController::class,
            'store',
        ])->name('projects.render-pipelines.store');
        Route::delete('/projects/{project}/render-pipelines/{renderPipeline}', [
            ProjectRenderPipelinesController::class,
            'destroy',
        ])->name('projects.render-pipelines.destroy');

        Route::apiResource('commands', CommandController::class);

        // Command Arguments
        Route::get('/commands/{command}/arguments', [
            CommandArgumentsController::class,
            'index',
        ])->name('commands.arguments.index');
        Route::post('/commands/{command}/arguments', [
            CommandArgumentsController::class,
            'store',
        ])->name('commands.arguments.store');

        // Command Render Pipelines
        Route::get('/commands/{command}/render-pipelines', [
            CommandRenderPipelinesController::class,
            'index',
        ])->name('commands.render-pipelines.index');
        Route::post('/commands/{command}/render-pipelines/{renderPipeline}', [
            CommandRenderPipelinesController::class,
            'store',
        ])->name('commands.render-pipelines.store');
        Route::delete('/commands/{command}/render-pipelines/{renderPipeline}', [
            CommandRenderPipelinesController::class,
            'destroy',
        ])->name('commands.render-pipelines.destroy');

        Route::apiResource('arguments', ArgumentController::class);

        Route::apiResource('render-pipelines', RenderPipelineController::class);

        // RenderPipeline Commands
        Route::get('/render-pipelines/{renderPipeline}/commands', [
            RenderPipelineCommandsController::class,
            'index',
        ])->name('render-pipelines.commands.index');
        Route::post('/render-pipelines/{renderPipeline}/commands', [
            RenderPipelineCommandsController::class,
            'store',
        ])->name('render-pipelines.commands.store');

        // RenderPipeline Commands
        Route::get('/render-pipelines/{renderPipeline}/commands', [
            RenderPipelineCommandsController::class,
            'index',
        ])->name('render-pipelines.commands.index');
        Route::post('/render-pipelines/{renderPipeline}/commands/{command}', [
            RenderPipelineCommandsController::class,
            'store',
        ])->name('render-pipelines.commands.store');
        Route::delete('/render-pipelines/{renderPipeline}/commands/{command}', [
            RenderPipelineCommandsController::class,
            'destroy',
        ])->name('render-pipelines.commands.destroy');

        // RenderPipeline Projects
        Route::get('/render-pipelines/{renderPipeline}/projects', [
            RenderPipelineProjectsController::class,
            'index',
        ])->name('render-pipelines.projects.index');
        Route::post('/render-pipelines/{renderPipeline}/projects/{project}', [
            RenderPipelineProjectsController::class,
            'store',
        ])->name('render-pipelines.projects.store');
        Route::delete('/render-pipelines/{renderPipeline}/projects/{project}', [
            RenderPipelineProjectsController::class,
            'destroy',
        ])->name('render-pipelines.projects.destroy');

        Route::apiResource('pages', PageController::class);

        // Page Sections
        Route::get('/pages/{page}/sections', [
            PageSectionsController::class,
            'index',
        ])->name('pages.sections.index');
        Route::post('/pages/{page}/sections', [
            PageSectionsController::class,
            'store',
        ])->name('pages.sections.store');

        // Page Sections
        Route::get('/pages/{page}/sections', [
            PageSectionsController::class,
            'index',
        ])->name('pages.sections.index');
        Route::post('/pages/{page}/sections/{section}', [
            PageSectionsController::class,
            'store',
        ])->name('pages.sections.store');
        Route::delete('/pages/{page}/sections/{section}', [
            PageSectionsController::class,
            'destroy',
        ])->name('pages.sections.destroy');

        Route::apiResource('sections', SectionController::class);

        // Section Pages
        Route::get('/sections/{section}/pages', [
            SectionPagesController::class,
            'index',
        ])->name('sections.pages.index');
        Route::post('/sections/{section}/pages/{page}', [
            SectionPagesController::class,
            'store',
        ])->name('sections.pages.store');
        Route::delete('/sections/{section}/pages/{page}', [
            SectionPagesController::class,
            'destroy',
        ])->name('sections.pages.destroy');

        // Section Sections
        Route::get('/sections/{section}/sections', [
            SectionSectionsController::class,
            'index',
        ])->name('sections.sections.index');
        Route::post('/sections/{section}/sections/{section}', [
            SectionSectionsController::class,
            'store',
        ])->name('sections.sections.store');
        Route::delete('/sections/{section}/sections/{section}', [
            SectionSectionsController::class,
            'destroy',
        ])->name('sections.sections.destroy');
    });
