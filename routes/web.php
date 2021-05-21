<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

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

/* SETTERS */
Route::post(BudgetController::addUrl(), [BudgetController::class, 'create']);
Route::post(BudgetController::API_DIRECTORY . '/{budget_id}/set-goal', [BudgetController::class, 'setGoal']);
Route::post(BudgetController::API_DIRECTORY . '/{budget_id}/add-row', [BudgetController::class, 'addRow']);


/* GETTERS */
Route::get(BudgetController::API_DIRECTORY . '/{budget_id}/get-goal', [BudgetController::class, 'getGoal']);
Route::get(BudgetController::API_DIRECTORY . '/{budget_id}/list-rows', [BudgetController::class, 'listRows']);
