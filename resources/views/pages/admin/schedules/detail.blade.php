<x-admin-layout>
    <header class="header">
        <h1>{{ $schedule['year'] }} {{ App\Enum\Calendar::MONTHES[$schedule['month']] }}</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">

        <div class="m-schedule-table">
            <div class="m-week-row-th">
                @foreach(App\Enum\Calendar::WEEK_DAYS as $key => $week_day)
                    <div 
                        class="m-week-row-th__th"                    
                        @if($key == 6 || $key == 7)
                            style="color: red; font-weight:600;"
                        @endif                    
                    >
                        {{ App\Enum\Calendar::WEEK_DAYS[$key] }}
                    </div>
                @endforeach
            </div>

            @foreach ($weeks as $row)
                <div class="m-week-row-td">
                    @foreach ($row as $key => $day)
                        <div 
                            class="m-week-row-td__td m-schedule-{{ $day['work_shift'] }}"
                            @if($day['is_today']) style="border: 4px solid red;" @endif
                        >
                            {{ $day['day'] }}

                            @if($day['is_gone'])<div class="m-week-row-td__td-dark-filter"></div>@endif                            
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    </main>

</x-admin-layout>


