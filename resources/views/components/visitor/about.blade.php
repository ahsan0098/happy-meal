<section class="about mt-5 pt-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
                <div class="about-image">
                    <!-- About Image Start -->
                    <div class="about-img-1">
                        <figure class="reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                            <img src="{{ asset('assets/images/about-img-1.jpg') }}" alt="Delicious dishes served"
                                style="transform: translate(0px, 0px);">
                        </figure>
                    </div>
                    <!-- About Image End -->

                   
                </div>
            </div>
            <div class="col pe-lg-5 mt-lg-3 mb-4 mb-lg-0">
                <span class="text-uppercase fw-bold mb-4 d-block red-text">*about us</span>
                <h2 class="fs-1 fw-bold mb-4">Delicious food, delivered to your door</h2>
                <p class="fs-5">
                    We are passionate about serving fresh, flavorful dishes crafted with love. Whether you're dining in
                    or ordering online, our mission is to provide a memorable food experience made with the finest
                    ingredients.
                </p>
                <p class="fs-5">
                    From quick bites to gourmet meals, we offer a wide variety of cuisines to satisfy every craving. Our
                    online ordering and fast delivery service ensures your favorite dishes arrive hot and ready—just the
                    way you like them.
                </p>
                <a wire:navigate href="{{ route('about') }}"
                    class="primary-btn text-decoration-none px-5 py-3 text-white mt-4 d-inline-block fw-bold">Learn More
                    <i class='bx bx-chevron-right'></i></a>
            </div>
        </div>
    </div>
</section>