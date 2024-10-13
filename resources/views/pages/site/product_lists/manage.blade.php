<x-site-layout>

    <section class="page-banner">
        <h2>{{ __('product_lists.product_lists') }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="product-list-btn-block">
                <a title="add new product" href="{{ route('product-lists.create') }}">
                    {{ __("product_lists.add_product_list") }}
                </a>
            </div>             

            @if(count($product_lists) > 0)
                <ul class="prod-list">
                    @foreach($product_lists as $key => $list)
                        @php $bg_color = 'common-bg-color-' . $key; @endphp
                        @include("pages.site.product_lists.components.list-item", compact('bg_color'))
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("product_lists.no_product_lists") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>