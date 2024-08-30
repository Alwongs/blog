<li class="todo-list__item todo-item {{ App\Enum\Rates::RATES[$task->rate] }}">

    <a class="todo-item__title" href="{{ route('tasks.show', $task->id) }}" >&bull; {{$task->title}}</a>


    <div class="todo-item__actions">
        <div id="{{ $task->id }}" class="three-dots-icon"></div>

        <div id="{{ $task->id }}" class="todo-item__modal hidden">
            <ul class="todo-item__action-list">
                <li>
                    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                </li>
                <li>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button> 
                    </form>                  
                </li>

                @include('pages.site.tasks.components.todo-item-rates')

            </ul> 
        </div>
    </div>

</li>



