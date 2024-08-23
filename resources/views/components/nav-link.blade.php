@props(['active', 'class', 'value'])

@php

    if ($active ?? false) {
        $classActive = "active";
    } else {
        $classActive = "";
    }

    $class = $class ?? "";
    $classes = $class . " " . $classActive;   
    $value = $value ?? "empty-value" ;

@endphp

<a  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value }}
</a>
