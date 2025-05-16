@props(['disabled'=>false,'height'=>'350px'])

<div class="editor" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-control text-capitalize']) }} style="height: {{ $height }}">
  {!! $slot !!}
</div>

