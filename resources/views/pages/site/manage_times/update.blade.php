<x-site-layout>
    <section class="page-banner">
        <h2>{{ __('time_management.new_manage_time') }}</h2>
    </section>

    @include('includes.common.notification')

    <main class="main  todo-section">
        @if(isset($manage_time))
            <form class="form" action="{{ route('manage-times.update', $manage_time) }}" method="POST" >
                @method('PUT')
        @else
            <form class="form" action="{{ route('manage-times.store') }}" method="POST" >
        @endif
            @csrf
            <input type="hidden" name="manage_day_id" value="{{ $manage_day_id }}">

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($manage_time) ? $manage_time->title : '' }}" required  autofocus />
            </div>    

            <div class="form__input-block">
                <input name="time_from" type="text" placeholder="time from" value="{{ isset($manage_time) ? $manage_time->time_from : '' }}" required />
            </div>  

            <div class="form__input-block">
                <input name="time_to" type="text" placeholder="time to" value="{{ isset($manage_time) ? $manage_time->time_to : '' }}" required />
            </div>  

            <div class="form__input-block input-date-block">
                @include('components.time-picker')                     
            </div>            


            <div class="form__status-block">
                @foreach(App\Enum\Status::STATUSES as $key=>$status)
                    <input 
                        id="status-{{ $status }}" 
                        type="radio" 
                        name="status" 
                        class="product-status-{{ $status }}" 
                        value="{{ $key }}"
                        @if(isset($manage_time) && $manage_time->status == $key)
                            checked
                        @elseif(!isset($manage_time) && $key == 'A')
                            checked
                        @endif
                    />
                    <label for="status-{{ $status }}" class="{{ $status }}">{{ $status }}</label>
                @endforeach
            </div> 

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($manage_time))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>

        </form>

        <div class="divider"></div>

        <div class="product-list-detail-btn-block">
            <a class="product-list-detail-btn btn-grey" href="{{ route('manage-days.show', $manage_day_id) }}">Back</a>

            @if(isset($manage_time))
                <form class="product-list-detail-btn btn-red" action="{{ route('manage-times.destroy', $manage_time->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-products-btn" class="btn-red" type="submit">Delete</button> 
                </form> 
            @endif
        </div> 

    </main>

</x-site-layout>


