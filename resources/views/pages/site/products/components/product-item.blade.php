<li class="product-list__item todo-item">

    <a 
        class="product-list-item__title" 
        @if($product->status == App\Enum\Status::DISABLE) 
            style="color: lightgrey;"
        @endif
        href="{{ route('products.show', $product->id) }}"
        >
        &bull; {{$product->title}}
    </a>

    <div class="product-list-item__price">
        {{$product->price}}р
    </div>

    <div class="product-list-item__actions">
        <i class="three-dots-icon"></i>

        <div class="product-list-item__modal hidden">
            <ul class="product-list-item__action-list">           
                <li>
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
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

