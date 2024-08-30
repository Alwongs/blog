@php
    $rates = [
        [
            "value" => 5,
            "color" => "red",
        ],
        [
            "value" => 4,
            "color" => "orange",
        ],
        [
            "value" => 3,
            "color" => "yellow",
        ],
        [
            "value" => 2,
            "color" => "cyan",
        ],
        [
            "value" => 1,
            "color" => "green",
        ],
    ];
@endphp

@foreach ($rates as $item)
    <li>
        <a href="#" style="background: {{ $item['color'] }};" data-color="{{ $item['color'] }}">{{ $item['color'] }}</a>
    </li>
@endforeach