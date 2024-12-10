<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">

        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new task" href="{{ route('schedule-days.create') }}?return_url=tasks.index"></a>
        </div> 

        @if(count($schedule_days) != 0)
            <ul class="schedule-list">
                @foreach($schedule_days as $year => $year_months)

                    <li class="schedule-list__item">

                        <div class="schedule-list__item-schedule-year">
                            {{ $year }}
                        </div>   

                        @foreach($year_months as $month_index => $month_days)

                            <div class="m-schedule-table">
                                <h3 class="schedule-list__item-schedule-month">{{ App\Enum\Calendar::MONTHES[$month_index] }}</h3>

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

                                <div class="m-week-row-td" style="flex-wrap:wrap;">
                                    @for($x = 1; $x < $month_days[0]->week_day; $x++)
                                        <div class="m-week-row-td__td" style="border:none;"></div> 
                                    @endfor

                                    @foreach ($month_days as $day)
                                        <a href="{{ route('schedule-days.edit', $day->id) }}" 
                                            class="m-week-row-td__td m-schedule-{{ $day['shift_type'] }}"
                                            @if(App\Helpers\ScheduleDay::checkIfToday($day)) style="border: 5px solid red;" @endif
                                        >
                                            {{ $day['day'] }}
                                            @if(App\Helpers\ScheduleDay::isDayPassed($day))<div class="m-week-row-td__td-dark-filter"></div>@endif   
                                            @if(!empty($day['description']))<div class="m-week-row-td__td-flag">D</div>@endif                           
                                        </a>
                                    @endforeach
                                </div>
                            </div> 

                            <div class="m-schedule-footer">
                                <div class="schedule-btn-block">
                                    {{-- <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-blue">Edit</a> --}}
                                    <form action="{{ route('scedule-days-delete-month', $month_days[1]->timestamp) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            class="btn btn-red" 
                                            onclick="event.preventDefault(); if (confirm('Do you really want to delete the month?')) this.closest('form').submit();"
                                        >
                                            Delete
                                        </button> 
                                    </form>
                                </div>  
                            </div> 
                        @endforeach


                        <div style="height:50px;border-bottom:1px solid lightgrey;"></div>
                    </li>   
   
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif                  

    </main>

</x-admin-layout>
