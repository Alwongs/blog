@php
    $rates = [
        [
            "value" => 1,
            "color" => "red",
        ],
        [
            "value" => 2,
            "color" => "orange",
        ],
        [
            "value" => 3,
            "color" => "yellow",
        ],
        [
            "value" => 4,
            "color" => "cyan",
        ],
        [
            "value" => 5,
            "color" => "green",
        ],
    ];
@endphp

@foreach ($rates as $item)
    <li>
        <a href="#" style="background: {{ $item['color'] }};" data-color="{{ $item['color'] }}">{{ $item['color'] }}</a>
    </li>
@endforeach