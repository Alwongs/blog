<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">

        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new task" href="{{ route('schedules.create') }}?return_url=tasks.index"></a>
        </div> 

        @if(count($schedules) != 0)
            <ul class="schedule-list">
                @foreach($schedules as $index => $schedule)
                    <li class="schedule-list__item">

                        <div class="schedule-list__item-schedule-month">
                            <a href="{{ route('schedules.show', $schedule->id) }}">
                                {{ $schedule->year }} {{ App\Enum\Calendar::MONTHES[$schedule->month] }}
                            </a>
                        </div>   
                        
                        {{-- <div class="schedule-list__item-title">
                            <div class="schedule-table">
                                @foreach (unserialize($schedule['schedule']) as $key => $day)
                                    <div class="schedule-col-small">
                                        <div
                                            class="schedule-col__th-small"
                                            @if($day['week_day'] == 6 || $day['week_day'] == 7)
                                                style="color: red;"
                                            @endif                                            
                                        >
                                            {{ App\Enum\Calendar::WEEK_DAYS[$day['week_day']] }}
                                        </div>
                                        <div class="schedule-col__td-small schedule-{{ $day['work_shift'] }}">
                                            {{ $key }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>    --}}
                        
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
                
                            @foreach ($weeksArray[$index] as $row)
                                <div class="m-week-row-td">
                                    @foreach ($row as $key => $day)
                                        <div 
                                            class="m-week-row-td__td m-schedule-{{ $day['work_shift'] }}"
                                        >
                                            {{ $day['day'] }}
                
                                            @if($day['is_gone'])<div class="m-week-row-td__td-dark-filter"></div>@endif                            
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>  



                        {{-- <div class="schedule-btn-block">
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-blue">Edit</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button href="{{ route('schedules.destroy', $schedule->id) }}" class="btn btn-red">Delete</button> 
                            </form>
                        </div>   --}}
                    </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif                  

    </main>

</x-admin-layout>
