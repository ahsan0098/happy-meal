<header class="py-3">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent p-0">
            <a wire:navigate class="navbar-brand" href="{{ route('home') }}">
                <x-admin.image :image="config('setting.site_general_logo')" default="assets/images/logo.jpg"
                    alt="{{ config('setting.site_general_name') }}" width="70px" />
            </a>
            <button class="navbar-toggler black-bg py-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span><i class='bx bx-menu text-black'></i></span>
            </button>
            <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a wire:navigate class="nav-link text-uppercase {{ Route::is('home')?'active':'' }} px-4" aria-current="page"
                            href="{{ route('home') }}">
                            Home</a>
                    </li>

                    <li class="nav-item">
                        <a wire:navigate class="nav-link text-uppercase {{ Route::is('food-menus')?'active':'' }} px-4"
                            aria-current="page" href="{{ route('food-menus') }}">
                            Food Menus</a>
                    </li>

                    <li class="nav-item">
                        <a wire:navigate class="nav-link text-uppercase {{ Route::is('about')?'active':'' }} px-4" aria-current="page"
                            href="{{ route('about') }}">
                            About</a>
                    </li>

                    <li class="nav-item">
                        <a wire:navigate class="nav-link text-uppercase {{ Route::is('contact')?'active':'' }} px-4"
                            aria-current="page" href="{{ route('contact') }}">
                            Contact</a>
                    </li>
                </ul>
                <div class="navbtn">
                    <a wire:navigate href="{{ route('track-order') }}"
                        class="ms-2 btn p-2 mb-0 float-end secondary-btn small d-flex align-items-center gap-1"><span>Track</span>
                        <i class='bx bxs-hourglass'></i></a>

                    <a wire:navigate href="{{ route('cart-items') }}"
                        class="btn p-2 mb-0 float-end primary-btn small d-flex align-items-center gap-1"><span>Cart</span>
                        <i class='bx bxs-cart fs-4'></i></a>
                    
                </div>
            </div>
        </nav>
    </div>
</header>