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

                        <div class="row">
                            <div class="col-md-6">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Email Subject" />
                                    <x-admin.form.input-field wire:model="form.subject" />
                                    <x-admin.form.input-error :messages="$errors->get('form.subject')" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class=" mb-3">
                                    <x-admin.form.input-label value="Any Link (optional)" />
                                    <x-admin.form.input-field wire:model="form.link" />
                                    <x-admin.form.input-error :messages="$errors->get('form.link')" />
                                </div>
                            </div>


                            <div class="col-12">
                                <div class=" mb-3" wire:ignore>
                                    <x-admin.form.input-label value="Message Body" />
                                    <x-admin.form.textarea-field wire:model="form.message" rows="5">
                                        
                                    </x-admin.form.textarea-field>
                                </div>
                                <x-admin.form.input-error :messages="$errors->get('form.message')" />
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