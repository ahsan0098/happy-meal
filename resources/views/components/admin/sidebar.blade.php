<nav class="sidebar" id="sidebar">
    <button class="close-button" id="close-button">
        <i class="fa-regular fa-circle-xmark"></i>
    </button>
    <div class="sidebar-header mb-4 text-center">
        <x-admin.image :image="config('setting.site_general_logo')" alt="{{ config('setting.site_general_name') }}"
            height="60px" />
    </div>
    <ul class="sidebar-menu p-0">
        <li>
            <a href="{{ route('admin.dashboard') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.dashboard')?'active':'' }}">
                <x-admin.icons.dashboard />
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.menus.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.menus.*')?'active':'' }}">
               <i class="fa-solid fa-bars"></i>
                Food Menus
            </a>
        </li>

        <li>
            <a href="{{ route('admin.items.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.items.*')?'active':'' }}">
                <i class="fa-solid fa-bowl-food"></i>
                Food Items
            </a>
        </li>

        <li>
            <a href="{{ route('admin.chefs.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.chefs.*')?'active':'' }}">
                <i class="fa-solid fa-user"></i>
                Chefs
            </a>
        </li>

        <li>
            <a href="{{ route('admin.orders.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.orders.process')?'active':'' }}">
                <i class="fa-solid fa-bag-shopping"></i>
                Pending Orders
            </a>
        </li>

        <li>
            <a href="{{ route('admin.orders.history') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.orders.history')?'active':'' }}">
                <i class="fa-solid fa-cart-shopping"></i>
                Orders History
            </a>
        </li>
        <li>
            <a href="{{ route('admin.admins.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is(['admin.admins.*','admin.gallery.*'])?'active':'' }}">
                <i class="fa-solid fa-user"></i>
                Admins
            </a>
        </li>




        <li>
            <a href="{{ route('admin.subscribers.index') }}" wire:navigate
                class="d-flex align-items-center gap-2 {{ Route::is('admin.subscribers.*')?'active':'' }}">
                <span class="fs-6">@</span>
                NewsLetter Subscribers
            </a>
        </li>

        <li>
            <a href="{{ route('admin.settings.index') }}" class="d-flex align-items-center gap-2" wire:navigate>
                <i class="fa-solid fa-cog"></i>
                Settings
            </a>
        </li>
    </ul>
</nav>