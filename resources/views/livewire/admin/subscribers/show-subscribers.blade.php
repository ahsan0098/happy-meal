<div>
    <x-admin.breadcrumb :breadcrumb="$this->breadcrumb??''" />

    <div class="wrapper mt-4">
        <div class="row px-3">
            <div class="table-search text-end mb-3">
              
                <div class="float-start">
                    <a href="{{ route('admin.subscribers.send') }}"
                        class="btn-sm btn primary-btn px-3 py-2 text-white small" wire:navigate>
                        Send News Letter To All
                    </a>
                </div>
               
                <div>
                    <x-admin.search-box model="search" placeholder="Search..." />
                </div>
            </div>
            <div class="table-responsive position-relative p-0 rounded-4">
                <x-admin.overlay model="search" />

                <table class="mb-0 custom-table w-100">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col" class="small fw-semibold py-3 ps-3">#</th>
                            <th scope="col" class="small fw-semibold py-3">Client Email</th>
                            <th scope="col" class="small fw-semibold py-3">Status</th>
                            <th scope="col" class="small fw-semibold py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $this->subscribers->firstItem();
                        @endphp
                        @forelse($this->subscribers as $subscriber)
                        <tr class="">
                            <td class="ps-3" scope="row">{{ $i++ }}</td>

                            <td class="small">
                                {{ $subscriber->email?? 'N/A' }}
                            </td>
                            <td>
                                <span
                                    class="badge text-body text-uppercase bg-opacity-50 small fw-semibold py-2 px-3 {{ ($subscriber->status == 
                                    'active'?'bg-success':'bg-danger') }}">{{
                                    $subscriber->status }}</span>
                            </td>
                            <td>

                               
                                @if ($subscriber->status == 'active')
                                <x-admin.action-button class="p-2 bg-danger me-1"
                                    wire:click.prevent="changeStatus({{ $subscriber->id}},'baned')"
                                    title="Ban">
                                    <i class="fa fa-ban"></i>
                                </x-admin.action-button>
                                @else
                                <x-admin.action-button class="p-2 bg-success me-1"
                                    wire:click.prevent="changeStatus({{ $subscriber->id}},'active')" title="activate">
                                    <i class="fa fa-check"></i>
                                </x-admin.action-button>
                                @endif
                               

                            </td>
                        </tr>

                        @empty
                        <x-admin.empty-table colspan="4" />
                        @endforelse
                    </tbody>
                </table>

                <x-admin.table-result :item="$this->subscribers" />
            </div>

            <x-admin.pagination :paginator="$this->subscribers" :scrollTo="false" />
        </div>
    </div>
</div>