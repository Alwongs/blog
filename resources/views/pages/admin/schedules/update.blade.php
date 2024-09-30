<x-admin-layout>
    <header class="header">
        <h1>
            @isset($post){{ __('schedule.update') }}@else{{ __('schedules.new_schedule') }}@endisset
        </h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($schdule))
            <form class="form" action="{{ route('schedules.update', $schdule) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data">
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
                <select name="days_in_month" type="text" required >
                    <option>{{ __("schedules.days_in_month") }}</option>                    
                    @foreach([28,29,30,31] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>     
            
            <div class="form__input-block input-type-block">
                <select name="first_day_index" type="text" required >
                    <option>{{ __("schedules.first_day_index") }}</option>                    
                    @foreach(App\Helpers\Schedule::WORK_SCHEDULE as $key => $item)
                        <option class="schedule-{{ $item }}" value="{{ $key }}">{{ App\Helpers\Schedule::FULL_DAY_PERIOD[$item] }} - {{ $key+1  }}</option>
                    @endforeach
                </select>
            </div>     
            
            <div class="form__input-block input-type-block">
                <select name="first_week_day" type="text" required >
                    <option>{{ __("schedules.first_week_day") }}</option>                    
                    @foreach(App\Enum\Calendar::WEEK_DAYS as $key => $item)
                        <option value="{{ $key }}">{{ App\Enum\Calendar::WEEK_DAYS[$key] }}</option>
                    @endforeach
                </select>
            </div>              

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green">
                    @if(isset($schedule))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>
        </form>

    </main>

</x-admin-layout>


