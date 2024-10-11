<x-site-layout>

    <section class="page-banner">
        <h2>{{ __('product_lists.product_lists') }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="todo-list-btn-block">
                <a title="add new task" href="{{ route('product-lists.create') }}">+</a>
            </div> 

            @if(count($product_lists) > 0)
                <ul class="todo-list">
                    @foreach($product_lists as $list)
                        @include("pages.site.product_lists.components.list-item")
                    @endforeach
                </ul>

                <form class="btn-block" action="{{ route('clear-tasks') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-tasks-btn" class="clear-tasks-btn" type="submit">Clear</button> 
                </form> 
            @else
                <p class="empty-list-note">{{ __("product_lists.no_product_lists") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>