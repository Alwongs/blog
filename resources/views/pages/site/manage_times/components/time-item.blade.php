<li 
    @if($manage_time->status == App\Enum\Status::DISABLE)
        class="manage-day__item manage-day-item mute" 
    @else
        class="manage-day__item manage-day-item" 
    @endif
>
    <div class="manage-day-item__time">
        {{$manage_time->time_from}} - {{$manage_time->time_to}}
    </div>

    <a class="manage-day-item__title" href="{{ route('manage-times.edit', $manage_time->id) }}">
        {{$manage_time->title}}
    </a>

    {{-- <div class="manage-day-item__duration-time">
        @if($manage_time->duration_time < 60)
            {{ $manage_time->duration_time }} <small>{{ __("time_management.minutes_middle") }}</small>
        @else
            {{ round($manage_time->duration_time / 60, 1) }} <small>{{ __("time_management.hours_short") }}</small>
        @endif

    </div> --}}

    <form class="manage-day-item__status" action="{{ route('manage-times.update', $manage_time) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="title" value="{{ $manage_time->title }}" />
        <input type="hidden" name="manage_day_id" value="{{ $manage_time->manage_day_id }}" />
        <input type="hidden" name="time_from" value="{{ $manage_time->time_from }}" />

        @if($manage_time->status == App\Enum\Status::ACTIVE)
            <input type="hidden" name="status" value="{{ App\Enum\Status::DISABLE }}" />
            <button class="action-list-disable" type="submit">{{ App\Enum\Status::STATUSES[App\Enum\Status::ACTIVE] }}</button>
        @else
            <input type="hidden" name="status" value="{{ App\Enum\Status::ACTIVE }}" />
            <button class="action-list-active" type="submit">{{ App\Enum\Status::STATUSES[App\Enum\Status::DISABLE] }}</button>
        @endif
    </form>      

    <div class="manage-day-item__actions">
        <i class="three-dots-icon"></i>

        <div class="manage-day-item__modal hidden">
            <ul class="manage-day-item__action-list">           
                <li>
                    <a class="action-list-edit" href="{{ route('manage-times.edit', $manage_time->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('manage-times.destroy', $manage_time->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            class="action-list-delete"
                            id="delete-list-btn" 
                            type="submit"
                            onclick="event.preventDefault(); if (confirm('are you sure?')) this.closest('form').submit();"
                        >
                            Delete
                        </button> 
                    </form>                  
                </li>
            </ul> 
        </div>
    </div>

</li>

