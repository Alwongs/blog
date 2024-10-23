<x-site-layout>

    <section class="page-banner">
        <h2>{{ __('time_management.manage_days') }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="product-list-btn-block">
                <a title="add new product" href="{{ route('manage-days.create') }}">
                    {{ __("time_management.add_manage_day") }}
                </a>
            </div>             

            @if(count($manage_days) > 0)
                <ul class="prod-list">
                    @foreach($manage_days as $key => $day)
                        @php $bg_color = 'common-bg-color-' . $key; @endphp
                        @include("pages.site.manage_days.components.days-item", compact('bg_color'))
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("time_management.list_empty") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>