<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController; // <-- We will create this next


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public "Shop" Route
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // <-- Add this
Route::delete('cart/remove/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
// ... cart routes ...
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Welcome route
Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});
 // <-- Add this import at the top
// === ADMIN ROUTES ===
// We group all admin routes under 'auth' and our new 'admin' middleware.
// We also add a prefix '/admin' to all their URLs.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Product Management
    // URL will be /admin/products
    Route::resource('products', ProductController::class);

    // Category Management
    // URL will be /admin/categories
    Route::resource('categories', CategoryController::class);

    // Order Management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
});


require __DIR__.'/auth.php';


