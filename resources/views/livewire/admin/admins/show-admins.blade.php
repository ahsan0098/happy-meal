<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">

                <div class="float-start">
                    <a href="{{ route('admin.admins.create') }}"
                        class="btn-sm btn primary-btn px-3 py-2 text-white small" wire:navigate>
                        Create Admin
                    </a>
                </div>

                <div>
                    <x-admin.search-box model="search" placeholder="Search Admin..." />
                </div>
            </div>
            <div class="table-responsive position-relative p-0 rounded-4">
                <x-admin.overlay model="search" />

                <table class="mb-0 custom-table w-100">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col" class="small fw-semibold py-3 ps-3">#</th>
                            <th scope="col" class="small fw-semibold py-3">Full Name</th>
                            <th scope="col" class="small fw-semibold py-3">Email</th>
                            <th scope="col" class="small fw-semibold py-3">Phone</th>
                            
                            <th scope="col" class="small fw-semibold py-3">Status</th>
                            <th scope="col" class="small fw-semibold py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->admins->firstItem();
                        @endphp
                        @forelse($this->admins as $admin)
                        <tr>
                            <td class="ps-3" scope="row">{{ $i++ }}</td>
                            <td class="small">
                                <div class="d-flex align-items-center gap-2">

                                    <x-admin.image :image="$admin->image" width="40px"
                                        class="rounded-circle user-darg-none" alt="{{ $admin->full_name }}" />
                                    <span class="text-capitalize">
                                        {{ $admin->full_name }}
                                    </span>
                                </div>
                            </td>
                            <td class="small">{{ $admin->email }}</td>
                            <td class="small">{{ $admin->phone }}</td>
                            
                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ $admin->status == 'active'?'bg-success':'bg-danger' }}">{{
                                    Str::ucfirst($admin->status) }}</span>
                            </td>
                            <td>


                                <x-admin.action-button
                                    href="{{ $admin->id != Auth::guard('admin')->id()?route('admin.admins.edit', $admin->id):route('admin.profile') }}"
                                    class="bg-primary-subtle text-primary" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </x-admin.action-button>



                                @if($admin->id != Auth::guard('admin')->id())
                                <x-admin.delete-button class="p-2" :id="$admin->id" title="Delete">
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-admin.delete-button>
                                @endif

                            </td>
                        </tr>
                        @empty
                        <x-admin.empty-table colspan="6" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->admins" />
            </div>

            <x-admin.pagination :paginator="$this->admins" :scrollTo="false" />
        </div>
    </div>
</div>