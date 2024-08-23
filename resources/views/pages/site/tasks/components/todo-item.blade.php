<li class="todo-list__item todo-item">

    <div class="todo-item__title">
        <a href="{{ route('tasks.show', $task->id) }}" >{{$task->title}}</a>
    </div>

    <div class="todo-item__actions">
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">D</button> 
        </form>   
    </div>

</li>