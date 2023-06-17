<?php

use App\Http\Controllers\Api\V1\WebsiteController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

// Route for Website resource
Route::apiResources([
    'websites' => WebsiteController::class,
    'posts' => PostController::class,
]);
