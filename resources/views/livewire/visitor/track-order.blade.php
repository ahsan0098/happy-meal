<div>
    <div class="container">
        <div class="row my-4 text-center justify-content-center">
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" wire:model="search" class="p-3 w-100 rounded rounded-pill border"
                        placeholder="Enter your phone number or email to find orders">
                    <button wire:click="$refresh"
                        class="position-absolute top-50 end-0 translate-middle border-0 bg-transparent fs-1 text-secondary border-start ps-2 h-100 my-0"><i
                            class='bx bx-search-alt '></i></button>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($this->orders as $order)
            <div class="col-12 mb-3">
                <div class="card h-100 shadow-sm d-flex">
                    <div class="card-body">
                        <div class="d-flex gap-3 align-items-center justify-content-between">
                            <p><strong class="fs-4">Order ID :</strong> {{ $order->reference_id }}</p>
                            <p>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-1 px-3 {{ $order->status == 'approved' ?'bg-success':'bg-danger' }}">
                                    {{ $order->status }}
                                </span>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-12 my-2">
                                <strong class="fs-6">Ordered Items</strong>
                            </div>
                            @foreach ($order->items as $item)
                            <div class="col-md-6">
                                <p class="mb-2 border d-flex align-items-center p-2 rounded justify-content-between">
                                    <span>{{ $item->name }}</span>
                                    <span>{{ $item->price }}</span>
                                </p>
                            </div>
                            @endforeach
                        </div>

                        <div class="d-flex gap-3 align-items-center justify-content-between">
                            <p><span class="fs-5 fw-semibold">Order Date :</span> {{ $order->created_at->format('d M H:i
                                A') }}</p>
                            <p>
                                <span class="fs-5 fw-semibold">Delivery Time : <span
                                        class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-1 px-3">
                                        {{ Carbon\Carbon::parse($order->delivery_time)->format('d M H:i A') }}
                                    </span></span>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 p-2">
                <div class="alert alert-danger text-center">
                    <strong>No orders found!</strong>
                    <p class="my-2">
                        Provide your email or phone number or order ID to fetch your order.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>