<?php

use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Zild Cafe API  (all URLs start with /api)
|--------------------------------------------------------------------------
*/

// ---- Auth -----------------------------------------------------------------
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/customer/login', [AuthController::class, 'customerLogin'])->middleware('throttle:10,1');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->middleware('throttle:10,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::patch('/me/delivery-location', [AuthController::class, 'updateDeliveryLocation']);
    Route::get('/my-orders', [OrderController::class, 'mine']);
});

// ---- Menu (drinks.html / foods.html) ---------------------------------------
Route::get('/menu', [MenuController::class, 'menu']);
Route::get('/products', [MenuController::class, 'products']);
Route::get('/products/{slug}', [MenuController::class, 'show']);

// ---- Cart + checkout (cartN.html / checkout.html / placeorder.html) ---------
Route::get('/cart', [CartController::class, 'show']);
Route::post('/cart/items', [CartController::class, 'addItem'])->middleware('auth:sanctum');
Route::patch('/cart/items/{item}', [CartController::class, 'updateItem']);
Route::delete('/cart/items/{item}', [CartController::class, 'removeItem']);
Route::delete('/cart', [CartController::class, 'clear']);

Route::post('/orders', [OrderController::class, 'store'])->middleware(['auth:sanctum', 'throttle:20,1']);
Route::get('/orders/track', [OrderController::class, 'track'])->middleware('throttle:30,1');

// ---- Website content (index / blog / team / contact) ------------------------
Route::get('/blog', [ContentController::class, 'blog']);
Route::get('/blog/{slug}', [ContentController::class, 'blogPost']);
Route::get('/team', [ContentController::class, 'team']);
Route::get('/reviews', [ContentController::class, 'reviews']);
Route::post('/reviews', [ContentController::class, 'storeReview'])->middleware('throttle:5,1');
Route::get('/settings', [ContentController::class, 'settings']);
Route::post('/contact', [ContentController::class, 'contact'])->middleware('throttle:5,1');

// ---- Admin (needs a token of a user whose role = admin) ---------------------
Route::prefix('admin')->middleware(['auth:sanctum', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/dashboard', Admin\DashboardController::class);

    Route::apiResource('products', Admin\ProductController::class);
    Route::apiResource('categories', Admin\CategoryController::class)->parameters(['categories' => 'id']);
    Route::apiResource('blog-posts', Admin\BlogPostController::class)->parameters(['blog-posts' => 'id']);
    Route::apiResource('team-members', Admin\TeamMemberController::class)->parameters(['team-members' => 'id']);

    Route::apiResource('orders', Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::apiResource('reviews', Admin\ReviewController::class)
        ->parameters(['reviews' => 'id'])->only(['index', 'show', 'update', 'destroy']);
    Route::apiResource('messages', Admin\ContactMessageController::class)
        ->parameters(['messages' => 'id'])->only(['index', 'show', 'update', 'destroy']);
});
