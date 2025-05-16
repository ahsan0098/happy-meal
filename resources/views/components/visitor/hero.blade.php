<section class="hero">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="img">
                    <img src="{{ asset('assets/images/hero-bg.jpg') }}" width="100%" alt="">
                </div>
                <div class="hero-text py-5 mb-5">
                    <div class="row">
                        <div class="col-lg-10 col-xl-8">
                            <p class="text-capitalize red-text fw-bold">
                                Welcome to Happy Meal
                            </p>
                            <h1 class="text-white text-capitalize my-4">Craving something delicious?</h1>
                            <p class="text-white">
                                Whether you're in the mood for comfort food, a healthy bite, or something sweet, we
                                deliver your favorite meals <br> straight to your door — fresh, fast, and hot.
                            </p>
                            <a wire:navigate href="{{ route('food-menus') }}" class="primary-btn px-5 py-3 d-inline-block mt-4 me-md-4">Order
                                Now</a>
                            <a wire:navigate href="{{ route('about') }}"
                                class="white-btn px-5 py-3 d-inline-block mt-4">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>