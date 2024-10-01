<x-admin-layout>
    <header class="header">
        <h1>{{ $schedule['year'] }} {{ App\Enum\Calendar::MONTHES[$schedule['month']] }}</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">

        <div class="schedule-table">
            @foreach (unserialize($schedule['schedule']) as $key => $day)
                <div class="schedule-col">
                    <div
                        class="schedule-col_th"
                        @if($day['week_day'] == 6 || $day['week_day'] == 7)
                            style="color: red;"
                        @endif
                    >
                        {{ App\Enum\Calendar::WEEK_DAYS[$day['week_day']] }}
                    </div>                    
                    <div class="schedule-col_td schedule-{{ $day['work_shift'] }}">
                        {{ $key }}
                    </div>
                </div>
            @endforeach
        </div>

    </main>

</x-admin-layout>


