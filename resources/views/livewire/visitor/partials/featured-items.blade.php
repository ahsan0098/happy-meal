<section class="services fleet my-5 pt-5 ">
    <div class="container-fluid px-md-5 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="text-center mb-5">
                    <span class="text-capitalize fw-bold mb-1 d-block red-text">*our menu</span>
                    <h2 class="fw-bold mb-4">Delicious Meals Made Fresh. Fast Delivery. All Orders Carefully Packaged and Sanitized</h2>
                </div>                
            </div>
        </div>
        <div class="row">
            @foreach($this->items as $item)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 shadow-sm d-flex">
                    <div class="card-body p-0 d-flex gap-3 align-items-center">
                        <img src="{{ \App\Services\ImageService::getImageUrl($item->image) }}" class="card-img-left"
                            alt="{{ $item->name }}" style="width: 120px; height: 120px; object-fit: cover;">
                        <div class="w-100">
                            <h5 class="card-title text-primary fw-bold">{{ $item->name }}</h5>
                            <p class="card-text text-muted mb-2">{{ $item->description }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                @if(session()->get('cart', []) && array_key_exists($item->id, session()->get('cart')))
                                <button type="button" wire:click="removeFromCart({{ $item }})"
                                    class="secondary-btn btn-sm text-decoration-none p-2 text-white d-inline-block fw-semibold small">Remove
                                    From Cart
                                </button>
                                @else
                                <button type="button" wire:click="addToCart({{ $item }})"
                                    class="primary-btn btn-sm text-decoration-none p-2 text-white d-inline-block fw-semibold small">Add
                                    To Cart
                                </button>
                                
                                @endif

                                <small class="mt-2 mx-2">Rs {{ number_format($item->price, 2) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>