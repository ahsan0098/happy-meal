<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">

            <img src="{{\App\Services\ImageService::getImageUrl(config('setting.site_general_logo'))}}" class="logo"
                alt="{{ config('setting.site_general_name') }}">
        </x-mail::header>
    </x-slot:header>

    {!!$message!!}
    @if (!empty($link))
    <a href="{{ $link }}">Click to get more information. </a>
    @endif
    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            © {{ date('Y') }} {{ config('setting.site_general_name') }}. {{ __('All rights reserved.') }}
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>