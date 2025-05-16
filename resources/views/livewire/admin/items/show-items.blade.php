<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">

                <div class="float-start">
                    <a href="{{ route('admin.items.create') }}"
                        class="btn-sm btn primary-btn px-3 py-2 text-white small" wire:navigate>
                        Create Item
                    </a>
                </div>

                <div>
                    <x-admin.search-box model="search" placeholder="Search item" />
                </div>
            </div>
            <div class="table-responsive position-relative p-0 rounded-4">
                <x-admin.overlay model="search" />

                <table class="mb-0 custom-table w-100">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col" class="small fw-semibold py-3 ps-3">#</th>
                            <th scope="col" class="small fw-semibold py-3 ps-3">Image</th>
                            <th scope="col" class="small fw-semibold py-3">Name</th>
                            <th scope="col" class="small fw-semibold py-3">Menu</th>
                            <th scope="col" class="small fw-semibold py-3">Price</th>
                            <th scope="col" class="small fw-semibold py-3">Featured</th>
                            <th scope="col" class="small fw-semibold py-3">Available</th>
                            <th scope="col" class="small fw-semibold py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->items->firstItem();
                        @endphp
                        @forelse($this->items as $item)
                        <tr>
                            <td class="ps-3" scope="row">{{ $i++ }}</td>
                            <td class="small">
                                <x-admin.image :image="$item->image" width="40px" class="rounded-circle user-darg-none"
                                    alt="{{ $item->name }}" />
                            </td>
                            <td class="small">{{ $item->name }}</td>
                            <td class="small">{{ $item->menu?->name??'N/A' }}</td>
                            <td class="small">PKR {{ $item->price }}</td>
                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ $item->is_featured ?'bg-success':'bg-danger' }}">{{
                                    $item->is_featured ?'Featured':'Not Featured' }}</span>
                            </td>

                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ $item->is_available ?'bg-success':'bg-danger' }}">{{
                                    $item->is_available ?'Yes':'No' }}</span>
                            </td>
                            <td>


                                <x-admin.action-button href="{{ route('admin.items.edit', $item->id)}}"
                                    class="bg-primary-subtle text-primary" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </x-admin.action-button>


                                <x-admin.delete-button class="p-2" :id="$item->id" title="Delete">
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-admin.delete-button>


                            </td>
                        </tr>
                        @empty
                        <x-admin.empty-table colspan="8" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->items" />
            </div>

            <x-admin.pagination :paginator="$this->items" :scrollTo="false" />
        </div>
    </div>
</div>