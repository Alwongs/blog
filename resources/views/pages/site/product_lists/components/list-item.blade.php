<li class="todo-list__item todo-item">

    <a class="todo-item__title" href="{{ route('product-lists.show', $list->id) }}" >&bull; {{$list->title}}</a>

    <div class="todo-item__actions">
        <i class="three-dots-icon"></i>

        <div class="todo-item__modal hidden">
            <ul class="todo-item__action-list">           
                <li>
                    <a href="{{ route('product-lists.edit', $list->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('product-lists.destroy', $list->id) }}" method="POST">
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

