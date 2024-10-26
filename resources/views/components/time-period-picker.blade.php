<select name="time_from[hours]" type="text">
    @for ($i = 0; $i < 24; $i++)
        @php  if ($i < 10) { $h = "0" . $i; } else { $h = $i; } @endphp
        @isset($t_from_hours)
            @if ($t_from_hours == $i)
                <option value="{{ $h }}" selected>{{ $h }}</option>
            @else
                <option value="{{ $h }}">{{ $h }}</option>
            @endif
        @else
            <option value="{{ $h }}">{{ $h }}</option>      
        @endisset
    @endfor
</select>
:
<select name="time_from[minutes]" type="text">
    @for ($i = 0; $i < 60; $i++)
        @php  if ($i < 10) { $m = "0" . $i; } else { $m = $i; } @endphp
        @isset($t_from_minutes)
            @if ($t_from_minutes == $i)
                <option value="{{ $m }}" selected>{{ $m }}</option>
            @else
                <option value="{{ $m }}">{{ $m }}</option>
            @endif
        @else
            <option value="{{ $m }}">{{ $m }}</option>       
        @endisset
    @endfor
</select>  

&mdash;

<select name="time_to[hours]" type="text">
    @for ($i = 0; $i < 24; $i++)
        @php  if ($i < 10) { $h = "0" . $i; } else { $h = $i; } @endphp
        @isset($t_to_hours)
            @if ($t_to_hours == $i)
                <option value="{{ $h }}" selected>{{ $h }}</option>
            @else
                <option value="{{ $h }}">{{ $h }}</option>
            @endif
        @else
            <option value="{{ $h }}">{{ $h }}</option>      
        @endisset
    @endfor
</select>
:
<select name="time_to[minutes]" type="text">
    @for ($i = 0; $i < 60; $i++)
        @php  if ($i < 10) { $m = "0" . $i; } else { $m = $i; } @endphp
        @isset($t_to_minutes)
            @if ($t_to_minutes == $i)
                <option value="{{ $m }}" selected>{{ $m }}</option>
            @else
                <option value="{{ $m }}">{{ $m }}</option>
            @endif
        @else
            <option value="{{ $m }}">{{ $m }}</option>       
        @endisset
    @endfor
</select>  