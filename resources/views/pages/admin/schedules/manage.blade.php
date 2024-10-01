<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">

        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new task" href="{{ route('schedules.create') }}?return_url=tasks.index"></a>
        </div> 

        @if(count($schedules) != 0)
            <ul class="manage-list">
                @foreach($schedules as $schedule)
                    <li class="manage-list__item">

                        <div class="manage-list__item-schedule-month">
                            <a href="{{ route('schedules.show', $schedule->id) }}">
                                {{ $schedule->year }} {{ App\Enum\Calendar::MONTHES[$schedule->month] }}
                            </a>
                        </div>   
                        


                        <div class="manage-list__item-title">
                            <div class="schedule-table">
                                @foreach (unserialize($schedule['schedule']) as $key => $day)
                                    <div class="schedule-col-small">
                                        <div
                                            class="schedule-col_th-small"
                                            @if($day['week_day'] == 6 || $day['week_day'] == 7)
                                                style="color: red;"
                                            @endif                                            
                                        >
                                            {{ App\Enum\Calendar::WEEK_DAYS[$day['week_day']] }}
                                        </div>
                                        <div class="schedule-col_td-small schedule-{{ $day['work_shift'] }}">
                                            {{ $key }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>                           



                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="cell-btn btn-icon-edit"></a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button href="{{ route('schedules.destroy', $schedule->id) }}" class="cell-btn btn-icon-delete"></button> 
                        </form>     
                    </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif                  

    </main>

</x-admin-layout>
