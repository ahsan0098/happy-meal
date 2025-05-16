<footer class="py-5 mt-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 py-5">
            <div class="col mb-4 mb-lg-0">
                <h5 class="text-white mb-4 fw-bold">{{ config('setting.site_general_name') }}</h5>
                <p class="text-white small">
                    {{ config('setting.site_general_description') }}
                </p>
                <p class="text-white mb-1"><i class='bx bx-phone-call '></i> <span class="small">
                        {{ config('setting.site_general_phone') }}
                    </span></p>
                <p class="text-white mb-1"><i class='bx bx-envelope '></i> <span class="small">
                        {{ config('setting.site_general_email') }}
                    </span></p>
                <p class="text-white mb-1"><i class='bx bx-current-location '></i><span class="small">
                        {{ config('setting.site_general_address') }}
                    </span></p>

            </div>
            <div class="col mb-4 mb-lg-0 ps-lg-5">
                <h5 class="text-white mb-4 fw-bold">Company</h5>
                <ul class="links mb-0">
                    <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                    
                    <li><a wire:navigate href="{{ route('about') }}">About Us</a></li>
                    <li><a wire:navigate href="{{ route("contact") }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col mb-4 mb-lg-0">
               <h5 class="text-white mb-4 fw-bold">Working Hours</h5>
                <p class="text-white"><b>Mon - Fri :</b> 9:00 AM – 10:00 PM</p>
                <p class="text-white"><b>Sat :</b> 10:00 AM – 11:00 PM</p>
                <p class="text-white"><b>Off Day(s) :</b> Sunday</p>                
            </div>
            <div class="col mb-4 mb-lg-0">
                <h5 class="text-white mb-4 fw-bold">Subscribe to the Newsletters</h5>
                <div class="footer-newsletter-form">
                    <livewire:visitor.partials.subscribe />
                </div>

                <div class="d-md-flex align-items-center justify-content-center gap-3 social-media mt-5">
                    <a wire:navigate href="{{ config('setting.site_social_facebook') }}" class="text-white fs-4"><i class='bx bxl-facebook'></i></a>
                    <a wire:navigate href="{{ config('setting.site_social_linkedin') }}" class="text-white fs-4"><i class='bx bxl-linkedin'></i></a>
                    <a wire:navigate href="{{ config('setting.site_social_twitter') }}" class="text-white fs-4"><i class='bx bxl-twitter'></i></a>
                    <a wire:navigate href="{{ config('setting.site_social_instagram') }}" class="text-white fs-4"><i class='bx bxl-instagram'></i></a>
                </div>
                <div></div>
            </div>
        </div>
        <div class="pt-5 text-center" style="border-top: 1px solid rgba(168, 168, 168, 0.461);">
            <p class="mb-0 text-white">Copyright {{ config('setting.site_general_name') }} © {{ date('Y') }} All Rights Reserved.</p>
        </div>
    </div>
</footer>