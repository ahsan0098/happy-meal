<div>
    <x-visitor.banner title="Cart Items" />

    <div class="text-center my-4">
        <h2 class="text-black fw-bold">Cart Items</h2>
    </div>
    <div class="container">
        @if(count(session()->get('cart', [])))
        @php
        $total =0;
        @endphp
        <div class="row">
            @if(session()->has('error'))
            <div class="col-md-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @foreach(session()->get('cart', []) as $item)

            <div class="col-12 mb-4">
                <div class="card h-100 shadow-sm d-flex">
                    <div class="card-body p-0 d-flex gap-3 align-items-center">
                        <img src="{{ \App\Services\ImageService::getImageUrl($item['image']) }}" class="card-img-left"
                            alt="{{ $item['name'] }}" style="width: 120px; height: 120px; object-fit: cover;">
                        <div class="w-100 p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title text-primary fw-bold">{{ $item['name'] }}</h5>
                                <button type="button" wire:click="removeFromCart({{ json_encode($item) }})"
                                    class="secondary-btn btn-sm text-decoration-none p-2 text-white d-inline-block fw-semibold small">Remove
                                    From Cart
                                </button>
                            </div>
                            <p class="card-text text-muted mb-2">{{ $item['description'] }}</p>

                            <small class="mt-2 mx-2"><strong>Quantity</strong> : {{
                                $item['quantity']
                                }}</small>
                            <small class="mt-2 mx-2"><strong>Amount</strong> : Rs {{
                                number_format($sum = $item['price']*$item['quantity'], 2)
                                }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $total += $sum;
            @endphp
            @endforeach

            <div class="col-12 text-end">
                <p class="my-2"><strong>Bill</strong> : Rs {{
                    number_format($total, 2)
                    }}</p>

                <p class="my-2"><strong>Delivery Charges</strong> : Rs {{
                    number_format(config('setting.site_general_delivery_charges',0), 2)
                    }}</p>

                <p class="my-2"><strong>Total</strong> : Rs {{
                    number_format($total+config('setting.site_general_delivery_charges',0), 2)
                    }}</p>
                <a wire:navigate href="{{ route('checkout') }}"
                    class="primary-btn text-decoration-none px-3 py-2 text-white mt-4 d-inline-block fw-bold">Checkout
                    <i class='bx bx-chevron-right'></i></a>
            </div>
        </div>

        @else
        <h5>Cart Empty</h5>
        <p class="text-muted">Your cart is empty. Please <a href="{{ route('food-menus') }}"
                wire:wire:navigate>browse</a> our
            food item to add items to your cart.Thanks :)</p>
        @endif
    </div>
</div>