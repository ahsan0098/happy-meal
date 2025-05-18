<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb" />
    <div id="dialog" class="theme-dialog" wire:loading wire:target="save">
        <div class="modal-body text-center">
            <div class="spinner-border primary-text" role="status" style="width: 4rem; height: 4rem;">
            </div>
            <p class="mt-2">Please wait...</p>
        </div>
    </div>
    <div class="wrapper mt-4">
        <div class="row justify-content-center py-5">
            <div class="col-lg-9">
                <div class="profile-form">
                    <form wire:submit="save">
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="First Name" />
                                    <x-admin.form.input-field wire:model="first_name" />
                                    <x-admin.form.input-error :messages="$errors->get('first_name')" />
                                </div>
                            </div>
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Last Name" />
                                    <x-admin.form.input-field wire:model="last_name" />
                                    <x-admin.form.input-error :messages="$errors->get('last_name')" />
                                </div>
                            </div>
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Email" />
                                    <x-admin.form.input-field type="email" wire:model="email" />
                                    <x-admin.form.input-error :messages="$errors->get('email')" />
                                </div>
                            </div>
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Username" />
                                    <x-admin.form.input-field wire:model="username" />
                                    <x-admin.form.input-error :messages="$errors->get('username')" />
                                </div>
                            </div>
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Phone Number" />
                                    <x-admin.form.input-field wire:model="phone" />
                                    <x-admin.form.input-error :messages="$errors->get('phone')" />
                                </div>
                            </div>
                            <div class="col">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Address" />
                                    <x-admin.form.input-field wire:model="address" />
                                    <x-admin.form.input-error :messages="$errors->get('address')" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-field position-relative">
                                        <i class="prefix-icon fa-solid fa-lock position-absolute"></i>
                                        <x-admin.form.input-label value="{{ __('Password') }}" />
                                        <x-admin.form.input-field wire:model="password" type="password"
                                            placeholder="Enter new password" autocomplete="new-password" />

                                        <div class="postfix-icon position-absolute" data-password>
                                            <i class="fa-solid fa-eye" style="cursor: pointer"></i>
                                            <i class="fa-solid fa-eye-slash" style="display: none; cursor: pointer"></i>
                                        </div>
                                    </div>
                                    <x-admin.form.input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-field position-relative">
                                        <i class="prefix-icon fa-solid fa-lock position-absolute"></i>
                                        <x-admin.form.input-label value="{{ __('Confirm Password') }}" />
                                        <x-admin.form.input-field wire:model="password_confirmation"
                                            type="password" placeholder="Enter new password again"
                                            autocomplete="new-password" />

                                        <div class="postfix-icon position-absolute" data-password>
                                            <i class="fa-solid fa-eye" style="cursor: pointer"></i>
                                            <i class="fa-solid fa-eye-slash" style="display: none; cursor: pointer"></i>
                                        </div>
                                    </div>
                                    <x-admin.form.input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" wire:target="save" wire:loading.attr="disabled"
                            class="primary-btn px-3 py-2 mt-4 text-white mx-auto d-block small">Save <i
                                class="fa-solid fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>