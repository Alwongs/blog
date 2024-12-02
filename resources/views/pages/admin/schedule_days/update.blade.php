<x-admin-layout>
    <header class="header">
        <h1>
            @isset($day){{ __('schedule.update') }}@else{{ __('new_schedule_days') }}@endisset
        </h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($day))
            <form class="form" action="{{ route('schedules.update', $schdule) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('schedule-days.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}" />

            <div class="form__input-block input-type-block">
                <select name="year" type="text" placeholder="year" required >
                    <option>{{ __("schedules.select_year") }}</option>  
                    @foreach([2024,2025,2026,2027] as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>     

            <div class="form__input-block input-type-block">
                <select name="month" type="text" required >
                    <option>{{ __("schedules.select_month") }}</option>                    
                    @foreach([1,2,3,4,5,6,7,8,9,10,11,12] as $month)
                        <option value="{{ $month }}">{{ App\Enum\Calendar::MONTHES[$month] }}</option>
                    @endforeach
                </select>
            </div> 
            
            <div class="form__input-block input-type-block">
                <select name="first_day_shift_index" type="text" required >
                    <option>{{ __("schedules.first_day_index") }}</option>                    
                    @foreach(App\Helpers\ScheduleDay::WORK_SCHEDULE as $key => $item)
                        <option class="schedule-{{ $item }}" value="{{ $key }}">{{ App\Helpers\ScheduleDay::FULL_DAY_PERIOD[$item] }} - {{ $key+1  }}</option>
                    @endforeach
                </select>
            </div>     

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($day))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>
        </form>

    </main>

</x-admin-layout>


