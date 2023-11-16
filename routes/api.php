<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/ChatCompletion', function (Request $request) {
    $request->validate([
        'model' => 'required|in:blenderbot-400M-distill',
        'temperature' => 'required|numeric|min:0.7|max:0.7',
        'messages' => 'required|array|min:1',
        'messages.*.content' => 'required|string',
        'messages.*.role' => 'required|in:user,assistant,system',
    ]);



    return response()->json([
        'message' => [
            'role' => 'assistant',
            'content' => trim($result),
        ],
    ]);
});
