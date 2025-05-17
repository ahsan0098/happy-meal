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
                <h4 class="mb-5">Order Information</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Client Name:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ $order->name ??'Not Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Client email:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ $order->email ??'Not Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Client phone:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ $order->phone ??'Not Available' }}
                            </p>
                        </div>
                    </div>
                    @if($order->delivery_time)
                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Delivery Time:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ Carbon\Carbon::parse($order->delivery_time)->format('d M H:i A') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Client address:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ $order->address ??'Not Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Order status:</h6>
                            <span
                                class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-1 px-3 {{ $order->status == 'approved' ?'bg-success':'bg-danger' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-control">
                            <h6 class="form-label small text-capitalize">Bill Total:</h6>
                            <p class="text-capitalize text-muted mb-0">
                                {{ $order->bill ??'Not Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-12 m-2">
                        <h5 class="form-label text-capitalize my-4">Ordered Items</h5>
                        <div class="row">
                            @foreach($order->items as $item)
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card h-100 shadow-sm d-flex">
                                    <div class="card-body p-0 d-flex gap-3 align-items-center">
                                        <img src="{{ \App\Services\ImageService::getImageUrl($item->image) }}"
                                            class="card-img-left" alt="{{ $item->name }}"
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                        <div class="w-100">
                                            <p class="fw-semibold m-0">{{ $item->name }}</p>

                                            <div class="d-flex align-items-center justify-content-between">


                                                <small class="mt-2 mx-2">Rs {{ number_format($item->price, 2) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row p-3 border align-items-center justify-content-between">
                            @if($order->status !== "completed" && $order->delivery_time)
                            <div class="col-12 text-center">
                                <button wire:click="save('completed')" class="btn btn-primary btn-sm">Mark
                                    Oder As Completed</button>
                            </div>
                            @elseif(!$order->delivery_time)
                            <div class="col-md-6">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-md-6">
                                        <input type="time" class="w-100 rounded p-1" wire:model="delivery_time"
                                            placeholder="Delivery Time" />
                                        <x-admin.form.input-error :messages="$errors->get('delivery_time')" />
                                    </div>
                                    <div class="col-md-6">
                                        <button wire:click="save('approved')" class="btn btn-success btn-sm">
                                            Approve</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <h6 class="mb-0">OR</h6>
                            </div>

                            <div class="col-md-4">
                                <button wire:click="save('rejected')" class="btn btn-danger btn-sm">Mark
                                    Rejected</button>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>