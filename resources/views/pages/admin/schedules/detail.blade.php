<x-admin-layout>
    <header class="header">
        <h1>{{ $schedule['year'] }} {{ App\Enum\Calendar::MONTHES[$schedule['month']] }}</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">

        <div class="schedule-table">
            @foreach (unserialize($schedule['schedule']) as $key => $day)
                <div class="schedule-col">
                    <div class="schedule-col_td schedule-{{ $day }}">
                        {{ $key }}
                    </div>
                </div>
            @endforeach
        </div>

    </main>

</x-admin-layout>


