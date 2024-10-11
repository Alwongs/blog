<x-site-layout>

    <section class="page-banner">
        <h2>{{ $product_list->title }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="todo-list-btn-block">
                <a title="add new product" href="{{ route('products.create') }}?product_list_id={{ $product_list->id }}">+</a>
            </div> 

            @if(count($product_list->products) > 0)
                <ul class="todo-list">
                    @foreach($product_list->products as $product)
                        @include("pages.site.products.components.product-item")
                    @endforeach
                </ul>

                {{-- <form class="btn-block" action="{{ route('clear-products') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-products-btn" class="clear-products-btn" type="submit">Clear</button> 
                </form>  --}}
            @else
                <p class="empty-list-note">{{ __("products.no_products") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>