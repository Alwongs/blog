<x-site-layout>

    <section class="page-banner">
        <h2>{{ $manage_day->title }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="manage-day-btn-block">
                <h2 class="">{{ $manage_day->title }}</h2>
                <a title="add new manage time" href="{{ route('manage-times.create') }}?manage_day_id={{ $manage_day->id }}">
                    {{ __("time_management.add_manage_time") }}
                </a>
            </div> 

            @if(count($manage_day->manageTimes) > 0)
                <ul class="manage-day">
                    @foreach($manage_day->manageTimes as $manage_time)
                        @include("pages.site.manage_times.components.time-item")
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("product_lists.no_products") }}</p>
            @endif

            @if(count($manage_day->manageTimes) > 1)
                <div class="manage-day-sum">
                    <div class="manage-day-sum__label">
                        {{ __("time_management.general_time") }}:
                    </div>
                    <div class="manage-day-sum__sum @if($general_time > 24) text-red @endif">
                        {{ $general_time }} <small>{{ __("time_management.hours_short") }}</small>
                    </div>
                    <div class="manage-day-sum__space"></div>                
                </div>

                <div class="divider"></div>
            @endif 
            
            <div class="manage-day-detail-btn-block">
                <a class="manage-day-detail-btn btn-grey" href="{{ route('manage-days.index') }}">Back</a>

                @if(count($manage_day->manageTimes) > 1)
                    <form class="manage-day-detail-btn btn-green" action="{{ route('activate-times', $manage_day->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button id="clear-products-btn" class="btn-green" type="submit">
                            {{ __("product_lists.activate_all") }}
                        </button> 
                    </form> 

                    <form class="manage-day-detail-btn btn-red" action="{{ route('disable-times', $manage_day->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button id="clear-products-btn" class="btn-red" type="submit">
                            {{ __("product_lists.disable_all") }}
                        </button> 
                    </form> 
                @endif                
            </div>             
        </div>
    </section>


</x-site-layout>