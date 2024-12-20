@php
    $activeProducts = $list->activeProducts;
    $count = $activeProducts->count();
    $sum = $activeProducts->sum('price');
@endphp

<li class="prod-list-item {{ $bg_color }}">

    <a class="prod-list-item__title" href="{{ route('product-lists.show', $list->id) }}">{{$list->title}}</a>
    @if ($count != 0)
        <span class="prod-list-item__title-label">{{ $count }}</span>
    @endif

    @if ($sum != 0)
        <span class="prod-list-item__title-label-sum">{{ $sum }}руб</span>
    @endif

    <div class="prod-list-item__actions">
        <i class="three-dots-icon"></i>

        <div class="prod-list-item__modal hidden">
            <ul class="prod-list-item__action-list">           
                <li>
                    <a href="{{ route('product-lists.edit', $list->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('product-lists.destroy', $list->id) }}" method="POST">
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

