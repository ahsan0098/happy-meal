<div>
    <x-visitor.banner title="Contact" />

    <div class="contact-info-form mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Contact Information Start -->
                    <div class="contact-information">
                        <!-- Contact Information Title Start -->
                        <div class="section-title mb-5">
                            <h2 class="fw-bold text-white">
                                Contact information
                            </h2>

                            <p class="text-white">We Are Here For You, Any Time</p>
                        </div>
                        <!-- Contact Information Title End -->

                        <!-- Contact Information List Start -->
                        <div class="contact-info-list">
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item d-flex align-items-center gap-3 mb-5">
                                <!-- Icon Box Start -->
                                <div class="icon-box d-flex align-items-center">
                                    <i class='bx bx-phone-call fs-4 text-white'></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p class="mb-0 fw-bold text-white">{{ config('setting.site_general_phone') }}</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item d-flex align-items-center gap-3 mb-5">
                                <!-- Icon Box Start -->
                                <div class="icon-box d-flex align-items-center">
                                    <i class='bx bx-envelope fs-4 text-white'></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p class="mb-0 fw-bold text-white">{{ config('setting.site_general_email') }}</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item d-flex align-items-center gap-3 mb-5">
                                <!-- Icon Box Start -->
                                <div class="icon-box d-flex align-items-center">
                                    <i class='bx bx-location-plus fs-4 text-white'></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p class="mb-0 fw-bold text-white">{{ config('setting.site_general_address') }}</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->
                        </div>
                        <!-- Contact Information List End -->

                        <!-- Contact Information Social Start -->
                        <div class="contact-info-social">
                            <ul>
                                <li><a wire:navigate href="{{ config('setting.site_social_facebook') }}"><i class='bx bxl-facebook'></i></a></li>
                                <li><a wire:navigate href="{{ config('setting.site_social_instagram') }}"><i class='bx bxl-instagram-alt'></i></a></li>
                                <li><a wire:navigate href="{{ config('setting.site_social_twitter') }}"><i class='bx bxl-twitter'></i></a></li>
                                <li><a wire:navigate href="{{ config('setting.site_social_linkedin') }}"><i class='bx bxl-linkedin'></i></a></li>
                            </ul>
                        </div>
                        <!-- Contact Information Social End -->
                    </div>
                    <!-- Contact Information End -->
                </div>
                <div class="col-lg-6">
                    <!-- Contact Form Start -->
                    <div class="contact-us-form">
                        <div id="dialog" class="theme-dialog bg-white" wire:loading wire:target="save">
                            <div class="modal-body text-center">
                                <div class="spinner-border primary-text" role="status"
                                    style="width: 4rem; height: 4rem;">
                                </div>
                                <p class="mt-2">{{ __('Please wait...') }}</p>
                            </div>
                        </div>
                        <form wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <div class="form-floating">
                                        <input required wire:model="data.name" type="text" class="form-control"
                                            id="name" placeholder="{{ __('Name') }}">
                                        <label for="name">{{ __('Name') }}</label>
                                    </div>
                                    <x-admin.form.input-error :messages="$errors->get('data.name')" />
                                </div>

                                <div class="col-md-6 mb-5">
                                    <div class="form-floating">
                                        <input required wire:model="data.email" type="email"
                                            class="form-control" id="floatingInput"
                                            placeholder="name@example.com">
                                        <label for="floatingInput">{{ __('Email') }}</label>
                                    </div>
                                    <x-admin.form.input-error :messages="$errors->get('data.email')" />
                                </div>
                            </div>

                            <div class="col-12 mb-5">
                                <div class="form-floating">
                                    <input required wire:model="data.subject" type="text" class="form-control"
                                        id="floatingInput1" placeholder="{{ __('Subject') }}">
                                    <label for="floatingInput1">{{ __('Subject') }}</label>
                                </div>
                                <x-admin.form.input-error :messages="$errors->get('data.subject')" />
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating">
                                    <textarea required wire:model="data.message" class="form-control"
                                        placeholder="{{ __('Comments') }}" id="message"
                                        style="height: 150px"></textarea>
                                    <label for="message">{{ __('Comments') }}</label>
                                </div>
                                <x-admin.form.input-error :messages="$errors->get('data.message')" />
                            </div>
                            <div class="form-floating">
                                <button class="btn primary-btn m-0"><i class="fa-solid fa-paper-plane"></i> {{
                                            __('Send Message') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form End -->
                </div>
            </div>
        </div>
    </div>



</div>