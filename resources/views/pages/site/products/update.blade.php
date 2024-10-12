<x-site-layout>
    <section class="page-banner">
        <h2>{{ __('product_lists.new_product') }}</h2>
    </section>

    @include('includes.common.notification')

    <main class="main  todo-section">
        @if(isset($product))
            <form class="form" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <input type="hidden" name="product_list_id" value="{{ $product_list_id }}">

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($product) ? $product->title : '' }}" required />
            </div>    

            <div class="form__input-block">
                <input name="price" type="text" placeholder="price" value="{{ isset($product) ? $product->price : '' }}" required />
            </div>  


            <div class="form__status-block">
                @foreach(App\Enum\Status::STATUSES as $key=>$status)
                    <input 
                        id="status-{{ $status }}" 
                        type="radio" 
                        name="status" 
                        class="product-status-{{ $status }}" 
                        value="{{ $key }}"
                        @if(isset($product) && $product->status == $key)
                            checked
                        @elseif(!isset($product) && $key == 'A')
                            checked
                        @endif
                    />
                    <label for="status-{{ $status }}" class="{{ $status }}">{{ $status }}</label>
                @endforeach
            </div> 







            <div class="form__color-block">
                @foreach(App\Enum\Rates::RATES as $key=>$rate)
                    <input 
                        id="rate-color-{{ $key }}" 
                        type="radio" 
                        name="rate" 
                        class="{{ $rate }}" 
                        value="{{ $key }}"
                        @if(isset($product) && $product->rate == $key)
                            checked
                        @elseif(!isset($product) && $key == 5)
                            checked
                        @endif
                    />
                    <label for="rate-color-{{ $key }}" class="{{ $rate }}"></label>
                @endforeach
            </div> 

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green">
                    @if(isset($product))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>

        </form>

        <div class="divider"></div>

        <div class="product-list-detail-btn-block">
            <a class="product-list-detail-btn btn-grey" href="{{ route('product-lists.show', $product_list_id) }}">Back</a>

            @if(isset($product))
                <form class="product-list-detail-btn btn-red" action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-products-btn" class="btn-red" type="submit">Delete</button> 
                </form> 
            @endif
        </div> 

    </main>

</x-site-layout>


