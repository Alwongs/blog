<x-site-layout>

    <section class="page-banner">
        <h2>{{ $manage_day->title }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="product-list-btn-block">
                <h2 class="">{{ $manage_day->title }}</h2>
                <a title="add new manage time" href="{{ route('manage-times.create') }}?manage_day_id={{ $manage_day->id }}">
                    {{ __("time_management.add_manage_time") }}
                </a>
            </div> 

            @if(count($manage_day->manageTimes) > 0)
                <ul class="product-list">
                    @foreach($manage_day->manageTimes as $manage_time)
                        @include("pages.site.manage_times.components.time-item")
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("product_lists.no_products") }}</p>
            @endif

            {{-- @if(count($manage_day->manage_times) > 1)
                <div class="product-list-sum">
                    <div class="product-list-sum__label">
                        {{ __("product_lists.sum") }}:
                    </div>
                    <div class="product-list-sum__sum">
                        {{ $sum }} р
                    </div>
                    <div class="product-list-sum__space"></div>                
                </div>

                <div class="divider"></div>
            @endif  --}}
            
            <div class="product-list-detail-btn-block">
                <a class="product-list-detail-btn btn-grey" href="{{ route('product-lists.index') }}">Back</a>

                @if(count($manage_day->manageTimes) > 1)
                    <form class="product-list-detail-btn btn-green" action="{{ route('activate-products', $manage_day->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button id="clear-products-btn" class="btn-green" type="submit">
                            {{ __("product_lists.activate_all") }}
                        </button> 
                    </form> 

                    <form class="product-list-detail-btn btn-red" action="{{ route('disable-products', $manage_day->id) }}" method="POST">
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