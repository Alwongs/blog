<x-site-layout>
    <section class="page-banner">
        <h2>{{ __('product_lists.new_product_list') }}</h2>
    </section>

    @include('includes.common.notification')

    <main class="main  todo-section">
        @if(isset($product_list))
            <form class="form" action="{{ route('product-lists.update', $product_list) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $product_list->user_id }}" />
        @else
            <form class="form" action="{{ route('product-lists.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ $user_id }}" />
        @endif
            @csrf



            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($product_list) ? $product_list->title : '' }}" required />
            </div>    

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green">
                    @if(isset($product_list))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>

        </form>

        <div class="divider"></div>

        <div class="product-list-detail-btn-block">
            <a class="product-list-detail-btn btn-grey" href="{{ route('product-lists.index') }}">Back</a>

            @if(isset($product_list))
                <form class="product-list-detail-btn btn-red" action="{{ route('product-lists.destroy', $product_list->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button id="clear-product_lists-btn" class="btn-red" type="submit">Delete</button> 
                </form> 
            @endif
        </div> 

    </main>

</x-site-layout>


