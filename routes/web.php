<?php

declare(strict_types=1);

use App\Livewire\Visitor\Home;
use App\Livewire\Visitor\About;
use App\Livewire\Visitor\Contact;
use App\Livewire\Visitor\CartItems;
use App\Livewire\Visitor\FoodMenus;
use App\Livewire\Visitor\PlaceOrder;
use App\Livewire\Visitor\TrackOrder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\CheckoutController;

// route return hello world arrow function


Route::get('/', Home::class)->name('home');
Route::get('/about-us', About::class)->name('about');
Route::get('/food-menus', FoodMenus::class)->name('food-menus');
Route::get('/contact-us', Contact::class)->name('contact');
Route::get('/cart-items', CartItems::class)->name('cart-items');
Route::get('/checkout', PlaceOrder::class)->name('checkout');

Route::get('/{reference_id}/error', [CheckoutController::class, 'stripeError'])->name('checkout.cancel');
Route::get('/{reference_id}/success', [CheckoutController::class, 'stripeSuccess'])->name('checkout.success');

Route::get('/checkout', PlaceOrder::class)->name('checkout');

Route::get('/track-order', TrackOrder::class)->name('track-order');

Route::name('admin.')->prefix('admin')->group(function (): void {
    require __DIR__ . '/admin.php';
});
