<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">

                <div class="float-start">
                    <a href="{{ route('admin.menus.create') }}"
                        class="btn-sm btn primary-btn px-3 py-2 text-white small" wire:navigate>
                        Create Menu 
                    </a>
                </div>

                <div>
                    <x-admin.search-box model="search" placeholder="Search menu" />
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
                            <th scope="col" class="small fw-semibold py-3">Items</th>
                            <th scope="col" class="small fw-semibold py-3">Featured On Home</th>
                            <th scope="col" class="small fw-semibold py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->menus->firstItem();
                        @endphp
                        @forelse($this->menus as $menu)
                        <tr>
                            <td class="ps-3" scope="row">{{ $i++ }}</td>
                            <td class="small">
                                <x-admin.image :image="$menu->image" width="40px" class="rounded-circle user-darg-none"
                                    alt="{{ $menu->name }}" />
                            </td>
                            <td class="small">{{ $menu->name }}</td>
                            <td class="small">{{ $menu->items_count }}</td>

                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ $menu->is_featured ?'bg-success':'bg-danger' }}">{{
                                    $menu->is_featured ?'Featured':'Not Featured' }}</span>
                            </td>
                            <td>


                                <x-admin.action-button href="{{ route('admin.menus.edit', $menu->id)}}"
                                    class="bg-primary-subtle text-primary" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </x-admin.action-button>


                                <x-admin.delete-button class="p-2" :id="$menu->id" title="Delete">
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-admin.delete-button>


                            </td>
                        </tr>
                        @empty
                        <x-admin.empty-table colspan="6" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->menus" />
            </div>

            <x-admin.pagination :paginator="$this->menus" :scrollTo="false" />
        </div>
    </div>
</div>