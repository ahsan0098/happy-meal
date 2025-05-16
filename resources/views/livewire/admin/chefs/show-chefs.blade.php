<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">

                <div class="float-start">
                    <a href="{{ route('admin.chefs.create') }}"
                        class="btn-sm btn primary-btn px-3 py-2 text-white small" wire:navigate>
                        Create Chef 
                    </a>
                </div>

                <div>
                    <x-admin.search-box model="search" placeholder="Search chef" />
                </div>
            </div>
            <div class="table-responsive position-relative p-0 rounded-4">
                <x-admin.overlay model="search" />

                <table class="mb-0 custom-table w-100">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col" class="small fw-semibold py-3 ps-3">#</th>
                            <th scope="col" class="small fw-semibold py-3 ps-3">Image</th>
                            <th scope="col" class="small fw-semibold py-3">Full Name</th>
                            <th scope="col" class="small fw-semibold py-3">Email</th>
                            <th scope="col" class="small fw-semibold py-3">Featured On Home</th>
                            <th scope="col" class="small fw-semibold py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->chefs->firstItem();
                        @endphp
                        @forelse($this->chefs as $chef)
                        <tr>
                            <td class="ps-3" scope="row">{{ $i++ }}</td>
                            <td class="small">
                                <x-admin.image :image="$chef->image" width="40px" class="rounded-circle user-darg-none"
                                    alt="{{ $chef->name }}" />
                            </td>
                            <td class="small">{{ $chef->name }}</td>
                            <td class="small">{{ $chef->email }}</td>

                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ $chef->is_featured ?'bg-success':'bg-danger' }}">{{
                                    $chef->is_featured ?'Featured':'Not Featured' }}</span>
                            </td>
                            <td>


                                <x-admin.action-button href="{{ route('admin.chefs.edit', $chef->id)}}"
                                    class="bg-primary-subtle text-primary" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </x-admin.action-button>


                                <x-admin.delete-button class="p-2" :id="$chef->id" title="Delete">
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-admin.delete-button>


                            </td>
                        </tr>
                        @empty
                        <x-admin.empty-table colspan="6" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->chefs" />
            </div>

            <x-admin.pagination :paginator="$this->chefs" :scrollTo="false" />
        </div>
    </div>
</div>