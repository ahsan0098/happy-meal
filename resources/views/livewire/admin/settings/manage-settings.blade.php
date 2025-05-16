<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb" />

    <div class="wrapper mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
               
                <div wire:ignore.self>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="fs-5 fw-semibold text-center mb-2">Site Logo</div>
                                    <form wire:submit="saveLogo">
                                        <div class="text-center">
                                            <x-admin.image-upload-view :model-var="$logo" :current-image="$this->settings->logo"
                                                model-name="logo" form-name="saveLogo" height="80px" width="200px"
                                                :is-rounded="false" />
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="fs-5 fw-semibold text-center mb-2">Site Favicon</div>
                                    <form wire:submit="saveFavicon">
                                        <div class="text-center">
                                            <x-admin.image-upload-view :model-var="$favicon" :current-image="$this->settings->favicon"
                                                model-name="favicon" form-name="saveFavicon" height="100px" width="100px"
                                                :is-rounded="false" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                
                            <div class="row">
                                <form wire:submit="save">
                                    <div class="row justify-content-evenly">
                                        @foreach($this->settings->general as $setting)
                                        @if(Str::contains($setting->key, 'textarea'))
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <x-admin.form.input-label
                                                    :value="Str::title(Str::replace('_general_textarea_',' ',$setting->key))" />
                                                <x-admin.form.textarea-field wire:model="form.key.{{ $setting->key }}" />
                                                <x-admin.form.input-error :messages="$errors->get('form.key.'.$setting->key)" />
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <x-admin.form.input-label
                                                    :value="Str::title(Str::replace('_general_',' ',$setting->key))" />
                                                <x-admin.form.input-field wire:model="form.key.{{ $setting->key }}" />
                                                <x-admin.form.input-error :messages="$errors->get('form.key.'.$setting->key)" />
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
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
        </div>
    </div>
</div>