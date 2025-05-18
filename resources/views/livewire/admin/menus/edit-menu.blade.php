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

                        <div class="row mb-3">
                            <div class="text-center">
                                <x-admin.image-upload-view :model-var="$image" model-name="image" form-name="save"
                                    :upload-btn="false" :current-image="$menu->image" />
                                <x-admin.form.input-error :messages="$errors->get('image')" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Menu Name" />
                                    <x-admin.form.input-field wire:model="name" />
                                    <x-admin.form.input-error :messages="$errors->get('name')" />
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <x-admin.form.input-label value="Feature On Home?" />
                                    <x-admin.form.select-field wire:model="is_featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </x-admin.form.select-field>
                                    <x-admin.form.input-error :messages="$errors->get('is_featured')" />
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