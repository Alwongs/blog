<li 
    @if($product->status == App\Enum\Status::DISABLE)
        class="product-list__item product-list-item mute" 
    @else
        class="product-list__item product-list-item" 
    @endif
>
    <a class="product-list-item__title" href="{{ route('products.edit', $product->id) }}">
        &bull; {{$product->title}}
    </a>

    <div class="product-list-item__price">
        {{$product->price}} р
    </div>

    <form class="product-list-item__status" action="{{ route('products.update', $product) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="title" value="{{ $product->title }}" />
        <input type="hidden" name="rate" value="{{ $product->rate }}" />
        <input type="hidden" name="product_list_id" value="{{ $product->product_list_id }}" />
        <input type="hidden" name="price" value="{{ $product->price }}" />

        @if($product->status == App\Enum\Status::ACTIVE)
            <input type="hidden" name="status" value="{{ App\Enum\Status::DISABLE }}" />
            <button class="action-list-disable" type="submit">{{ App\Enum\Status::STATUSES[App\Enum\Status::ACTIVE] }}</button>
        @else
            <input type="hidden" name="status" value="{{ App\Enum\Status::ACTIVE }}" />
            <button class="action-list-active" type="submit">{{ App\Enum\Status::STATUSES[App\Enum\Status::DISABLE] }}</button>
        @endif
    </form>      

    <div class="product-list-item__actions">
        <i class="three-dots-icon"></i>

        <div class="product-list-item__modal hidden">
            <ul class="product-list-item__action-list">           
                <li>
                    <a class="action-list-edit" href="{{ route('products.edit', $product->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            class="action-list-delete"
                            id="delete-list-btn" 
                            type="submit"
                            onclick="event.preventDefault(); if (confirm('are you sure?')) this.closest('form').submit();"
                        >
                            Delete
                        </button> 
                    </form>                  
                </li>
            </ul> 
        </div>
    </div>

</li>

