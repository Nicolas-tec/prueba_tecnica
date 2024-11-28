<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\StatsController;

Route::post('register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json($user, 201);
});

// Inicio de sesión de usuario
Route::post('login', function (Request $request) {
    $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Las credenciales no coinciden con nuestros registros.'],
        ]);
    }

    $token = $user->createToken('Token Personal')->plainTextToken;

    return response()->json(['token' => $token]);
});

// Ruta protegida (requiere autenticación)
Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('logout', function (Request $request) {
    $request->user()->tokens->each(function ($token) {
        $token->delete();
    });

    return response()->json(['message' => 'Sesión cerrada exitosamente']);
});
Route::prefix('stats')->group(function () {
    Route::get('/most-borrowed-books', [StatsController::class, 'mostBorrowedBooks']);
    Route::get('/most-active-users', [StatsController::class, 'mostActiveUsers']);
    Route::get('/most-available-books', [StatsController::class, 'mostAvailableBooks']);
    Route::get('/loans-per-month', [StatsController::class, 'loansPerMonth']);
    Route::get('/most-popular-categories', [StatsController::class, 'mostPopularCategories']);
});
