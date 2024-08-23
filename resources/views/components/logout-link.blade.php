@props(['class', 'value'])

@php
    $classes = $class ?? "";
@endphp

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a 
        {{ $attributes->merge(['class' => $classes]) }} 
        href="{{ route('logout') }}"
        onclick="event.preventDefault();this.closest('form').submit();"
    >
        {{ $value }}
    </a>
</form>
