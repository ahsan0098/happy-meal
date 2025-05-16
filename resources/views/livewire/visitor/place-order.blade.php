<div>
    <x-visitor.banner title="Checkout" />
    <div id="dialog" class="theme-dialog bg-white" wire:loading wire:target="save">
        <div class="modal-body text-center bg-white">
            <div class="spinner-border primary-text" role="status" style="width: 4rem; height: 4rem;">
            </div>
            <p class="mt-2">Please wait...</p>
        </div>
    </div>
    <div class="text-center my-4">
        <h2 class="text-black fw-bold">Checkout</h2>
    </div>
    <div class="container">
        <form wire:submit="save" class="mt-3">
            <h6>Please fill all the fields and click next.</h6>
            <div class="row ">
                <div class="col-12 col-md-6 mb-4">
                    <label for="name" class="small mb-2">Name</label>
                    <input wire:model="form.name" type="text" class="form-control" name="name" required
                        placeholder="Enter full name">
                    <x-admin.form.input-error :messages="$errors->get('form.name')" />
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="email" class="small mb-2">Email</label>
                    <input wire:model="form.email" type="email" class="form-control" name="email" required id="email"
                        placeholder="Enter your email">
                    <x-admin.form.input-error :messages="$errors->get('form.email')" />
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="number" class="small mb-2">Phone Number</label>
                    <input wire:model="form.phone" type="number" class="form-control" name="phone" required
                        placeholder="Enter your phone">
                    <x-admin.form.input-error :messages="$errors->get('form.phone')" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <label for="name" class="small mb-2">Bill</label>
                    <input value="{{ $form->bill}}" type="text" disabled readonly class="form-control" required
                        placeholder="Your bill">
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <label for="address" class="small mb-2">Address</label>
                    <textarea wire:model="form.address" class="form-control" required placeholder="Enter address"
                        name="address" rows="3"></textarea>
                    <x-admin.form.input-error :messages="$errors->get('form.address')" />
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <label for="comments" class="small mb-2">Optional Extra Information</label>
                    <textarea wire:model="form.comments" class="form-control" placeholder="Enter comments"
                        name="comments" rows="3"></textarea>
                    <x-admin.form.input-error :messages="$errors->get('form.comments')" />
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="nextBtn secondary-btn px-4 py-2">Next</button>
            </div>
        </form>
    </div>
</div>