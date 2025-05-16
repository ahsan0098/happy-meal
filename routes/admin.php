<?php

declare(strict_types=1);

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Chefs\EditChef;
use App\Livewire\Admin\Items\EditItem;
use App\Livewire\Admin\Menus\EditMenu;
use App\Livewire\Admin\Chefs\ShowChefs;
use App\Livewire\Admin\Items\ShowItems;
use App\Livewire\Admin\Menus\ShowMenus;
use App\Livewire\Admin\Admins\EditAdmin;
use App\Livewire\Admin\Chefs\CreateChef;
use App\Livewire\Admin\Items\CreateItem;
use App\Livewire\Admin\Menus\CreateMenu;
use App\Livewire\Admin\Admins\ShowAdmins;
use App\Livewire\Admin\Orders\ShowOrders;
use App\Livewire\Admin\Admins\CreateAdmin;
use App\Livewire\Admin\Auth\ResetPassword;
use App\Livewire\Admin\Orders\ReviewOrder;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Subscribers\SendNews;
use App\Livewire\Admin\Profile\UpdateProfile;
use App\Livewire\Admin\Settings\ManageSettings;
use App\Livewire\Admin\Subscribers\ShowSubscribers;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Livewire\Admin\Orders\OrderHistory;

// Redirect to admin.login by default
Route::get('/', fn() => redirect()->route('admin.login'))->name('admin');

// Middleware for guests only (not logged in)
Route::middleware('guest:admin')->group(function (): void {
    // Admin login route
    Route::get('login', Login::class)
        ->name('login');

    // Admin forgot password route
    Route::get('forgot-password', ForgotPassword::class)
        ->name('password.request');

    Route::get('reset-password/{id}/{token}', ResetPassword::class)
        ->middleware(['signed', 'throttle:10,1'])
        ->name('password.reset');
});

Route::get('email/verify/{admin}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:10,1'])
    ->name('verification.verify');

// Middleware for authenticated admin users only
Route::middleware('auth:admin')->group(function (): void {

    Route::get('profile', UpdateProfile::class)->name('profile');

    Route::middleware('verified:admin.profile')->group(function () {

        // Admin dashboard route
        Route::get('dashboard', Dashboard::class)->name('dashboard');

        // Admins Routes
        Route::get('admins', ShowAdmins::class)->name('admins.index');
        Route::get('admins/create', CreateAdmin::class)->name('admins.create');
        Route::get('admins/{admin}/edit', EditAdmin::class)->name('admins.edit');


        // Chefs Routes
        Route::get('chefs', ShowChefs::class)->name('chefs.index');
        Route::get('chefs/create', CreateChef::class)->name('chefs.create');
        Route::get('chefs/{chef}/edit', EditChef::class)->name('chefs.edit');

        // Menus Routes
        Route::get('menus', ShowMenus::class)->name('menus.index');
        Route::get('menus/create', CreateMenu::class)->name('menus.create');
        Route::get('menus/{menu}/edit', EditMenu::class)->name('menus.edit');

        // Items Routes
        Route::get('items', ShowItems::class)->name('items.index');
        Route::get('items/create', CreateItem::class)->name('items.create');
        Route::get('items/{item}/edit', EditItem::class)->name('items.edit');

        // Orders Routes
        Route::get('orders', ShowOrders::class)->name('orders.index');
        Route::get('orders/{order}/process', ReviewOrder::class)->name('orders.process');
        
        Route::get('orders/history', OrderHistory::class)->name('orders.history');


        // subscribers Routes
        Route::get('subscribers', ShowSubscribers::class)->name('subscribers.index');
        Route::get('subscribers/send-news', SendNews::class)->name('subscribers.send');


        Route::get('settings', ManageSettings::class)->name('settings.index');
    });
});
