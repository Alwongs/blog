<x-site-layout>

    <section class="page-banner">
        <h2>{{ $product_list->title }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="product-list-btn-block">
                <h2 class="">{{ $product_list->title }}</h2>
                <a title="add new product" href="{{ route('products.create') }}?product_list_id={{ $product_list->id }}">
                    {{ __("product_lists.add_product") }}
                </a>
            </div> 

            @if(count($product_list->products) > 0)
                <ul class="product-list">
                    @foreach($product_list->products as $product)
                        @include("pages.site.products.components.product-item")
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("product_lists.no_products") }}</p>
            @endif

            @if(count($product_list->products) > 1)
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
            @endif 
            
            <div class="product-list-detail-btn-block">
                <a class="product-list-detail-btn btn-grey" href="{{ route('product-lists.index') }}">Back</a>

                @if(count($product_list->products) > 1)
                    <form class="product-list-detail-btn btn-green" action="{{ route('activate-products', $product_list->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button id="clear-products-btn" class="btn-green" type="submit">
                            {{ __("product_lists.activate_all") }}
                        </button> 
                    </form> 

                    <form class="product-list-detail-btn btn-red" action="{{ route('disable-products', $product_list->id) }}" method="POST">
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