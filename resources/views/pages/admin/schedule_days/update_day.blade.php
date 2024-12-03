@php use App\Helpers\ScheduleDay; @endphp

<x-admin-layout>
    <header class="header">
        <h1>
            {{ $scheduleDay->day . "." . $scheduleDay->month . "." . $scheduleDay->year }}
        </h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        <form class="form" action="{{ route('schedule-days.update', $scheduleDay) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form__input-block input-type-block">
                <select name="shift_type" type="text" >                  
                    <option class="schedule-{{ ScheduleDay::DAY }}" value="{{ ScheduleDay::DAY }}" @if($scheduleDay->shift_type == ScheduleDay::DAY) selected @endif>
                        {{ ScheduleDay::FULL_DAY_PERIOD[ScheduleDay::DAY] }}
                    </option>
                    <option class="schedule-{{ ScheduleDay::NIGHT }}" value="{{ ScheduleDay::NIGHT }}" @if($scheduleDay->shift_type == ScheduleDay::NIGHT) selected @endif>
                        {{ ScheduleDay::FULL_DAY_PERIOD[ScheduleDay::NIGHT] }}
                    </option>
                    <option class="schedule-{{ ScheduleDay::DAY_OFF }}" value="{{ ScheduleDay::DAY_OFF }}" @if($scheduleDay->shift_type == ScheduleDay::DAY_OFF) selected @endif>
                        {{ ScheduleDay::FULL_DAY_PERIOD[ScheduleDay::DAY_OFF] }}
                    </option>
                </select>
            </div>     

            <div class="form__textarea-block">
                <textarea name="description" id="" cols="30" rows="10">{{ $scheduleDay->description }}</textarea>
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


