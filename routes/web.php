<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [CheckoutController::class, 'getUserOrders'])->name('orders.index');
    Route::get('/orders/{order}', [CheckoutController::class, 'showOrder'])->name('orders.show');
    Route::get('/orders', [CheckoutController::class, 'getUserOrders'])->name('orders.dashboard');
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
});

Route::get('userproducts', [ProductController::class, 'userproducts'])->name('products.userproducts');
// Display a listing of the products
Route::get('products/admin', [ProductController::class, 'index'])->name('products.index');

// Show the form for creating a new product
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

// Store a newly created product in storage
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');

// Display the specified product
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// Show the form for editing the specified product
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update the specified product in storage
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');

// Remove the specified product from storage
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


// Route for viewing all classes
Route::delete('/classes/{id}', [coachController::class, 'destroy'])->name('classes.destroy');


Route::get('/classes/search', [CoachController::class, 'search'])->name('classes.search');

Route::get('/coach/dashboard/classes', [CoachController::class, 'viewClasses'])->name('coach.dash');



Route::middleware('auth')->get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');

// Route for viewing the class details (checkout page)
Route::match(['get', 'post'], '/classes/{id}', [BookingController::class, 'showClass'])->name('classes.show')->middleware('auth');


// Route for booking a session
Route::post('/sessions/{sessionId}/book', [BookingController::class, 'bookSession'])->name('sessions.book')->middleware('auth');

// Route for showing the form to edit a session
Route::get('/coach/sessions/{id}/edit', [CoachController::class, 'editSession'])->name('coach.sessions.edit')->middleware('auth');

// Route for handling the form submission to update a session
Route::put('/coach/sessions/{id}', [CoachController::class, 'updateSession'])->name('coach.sessions.update')->middleware('auth');


// Route for fetching all classes
Route::get('/coach/classes', [CoachController::class, 'index'])->name('coach.classes');

// Route for booking a session
Route::resource('coaches', CoachController::class);

// Route for viewing the coach dashboard
Route::get('/coach/dashboard', [CoachController::class, 'view'])->name('coach.dashboard');

// Route for showing the form to create a new session
Route::get('/coach/sessions/create', [CoachController::class, 'create'])->name('coach.sessions.create');

// Route for handling the form submission to create a new session
Route::post('/coach/sessions', [CoachController::class, 'createSessions'])->name('coach.sessions.store');

// Route for showing the form to create a new coach
Route::get('/coach/create', [CoachController::class, 'create'])->name('coach.create');

// Route for handling the form submission to create a new coach
Route::post('/coach', [CoachController::class, 'store'])->name('coach.store');

// Admin Routes
Route::get('admin/users', [AdminController::class, 'loadAllUsers'])->name('admin.users');

Route::delete('admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

// Admin Orders Route
Route::get('admin/orders', [AdminController::class, 'getAllOrders'])->name('admin.orders');
Route::post('admin/orders/{orderId}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

// Stripe Checkout Routes
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'handleSuccess'])->name('checkout.success');

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard Route (requires authentication and email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    // Edit profile: View and edit user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Update profile: Save profile changes
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Delete profile: Delete the authenticated user's profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Authentication Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

// Resource route for products
Route::resource('products', ProductController::class);
