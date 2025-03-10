<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\StripePaymentController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Store the newly created meal plan
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('mealPlans.store');
    Route::get('/meal-plans/create', [MealPlanController::class, 'index'])->name('meal-plans.create');
    Route::get('/mealHome', [MealPlanController::class, 'mealHome'])->name('mealHome');
    Route::get('/payment', [StripePaymentController::class, 'payment'])->name('payment');
    Route::post('/payment', [StripePaymentController::class, 'createPayment']);
    Route::post('/stripe/webhook', [StripePaymentController::class, 'handleWebhook']);
});






require __DIR__ . '/auth.php';
