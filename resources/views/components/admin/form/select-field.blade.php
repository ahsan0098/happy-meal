@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-control text-capitalize']) }}>
    {{ $slot }}
</select>
