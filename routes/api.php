<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

// Real-time email validation for registration
Route::post('/validate-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email'
    ]);

    $email = $request->email;
    $exists = User::where('email', $email)->exists();

    return response()->json([
        'valid' => !$exists,
        'message' => $exists ? 'This email is already registered.' : 'Email is available.'
    ]);
})->name('api.validate-email');
