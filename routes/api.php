<?php

use App\Http\Controllers\Api\ProjectControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/projects', ProjectControllerApi::class)->only(['index', 'show']);
Route::get('project-by-type/{type_id}', [ProjectControllerApi::class, 'projectByType']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
