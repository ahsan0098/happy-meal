<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">

                <div>
                    <x-admin.search-box model="search" placeholder="Search order" />
                </div>
            </div>
            <div class="table-responsive position-relative p-0 rounded-4">
                <x-admin.overlay model="search" />

                <table class="mb-0 custom-table w-100">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col" class="small fw-semibold py-3 ps-3">#</th>
                            <th scope="col" class="small fw-semibold py-3 ps-3">ReferenceID</th>
                            <th scope="col" class="small fw-semibold py-3">Client</th>
                            <th scope="col" class="small fw-semibold py-3">Address</th>
                            <th scope="col" class="small fw-semibold py-3">Total</th>
                            <th scope="col" class="small fw-semibold py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->orders->firstItem();
                        @endphp
                        @forelse($this->orders as $order)
                        <tr>
                            <td class="ps-3" scope="row">{{ $i++ }}</td>
                            <td class="small">{{ $order->reference_id }}</td>
                            <td class="small">
                                <p class="mb-0">{{ $order->name }}</p>
                                <p class="mb-0">{{ $order->email }}</p>
                            </td>
                            <td class="small">{{ $order->address }}</td>
                            <td class="small">{{ $order->bill }}</td>
                            <td>
                                <x-admin.action-button href="{{ route('admin.orders.process', $order->id)}}" class="bg-primary-subtle text-primary"
                                    title="Process Order">
                                    <i class="fa-solid fa-cube"></i>
                                </x-admin.action-button>
                            </td>
                        </tr>
                        @empty
                        <x-admin.empty-table colspan="6" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->orders" />
            </div>

            <x-admin.pagination :paginator="$this->orders" :scrollTo="false" />
        </div>
    </div>
</div>