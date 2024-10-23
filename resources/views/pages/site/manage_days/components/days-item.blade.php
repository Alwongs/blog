<li class="prod-list-item {{ $bg_color }}">

    <a class="prod-list-item__title" href="{{ route('manage-days.show', $day->id) }}" >{{$day->title}}</a>

    <div class="prod-list-item__actions">
        <i class="three-dots-icon"></i>

        <div class="prod-list-item__modal hidden">
            <ul class="prod-list-item__action-list">           
                <li>
                    <a href="{{ route('manage-days.edit', $day->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('manage-days.destroy', $day->id) }}" method="POST">
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

