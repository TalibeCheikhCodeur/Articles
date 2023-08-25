<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

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

Route::apiResource('categories', CategorieController::class);

Route::post('categories/delete', [CategorieController::class, "supCat"]);

Route::post('categories/restore', [CategorieController::class, "restore"]);

Route::apiResource('addArticle', ArticleController::class);
Route::post("/addArticle", [ArticleController::class, "store"]);
Route::get('ids/{tissu}',[CategorieController::class,'getidCatBylib']);
