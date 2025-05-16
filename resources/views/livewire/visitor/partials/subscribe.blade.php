<form id="newslettersForm" wire:submit="save">
    <div class="form-group">
        <input type="email" name="email" class="form-control" wire:model="email" placeholder="Email ..." required>
        <button type="submit" class="section-icon-btn primary-btn"><i class='bx bx-search-alt-2'></i></button>
    </div>
    @error('email')
    <span class="ms-2 text-danger small">{{ $message }}</span>
    @enderror
</form>