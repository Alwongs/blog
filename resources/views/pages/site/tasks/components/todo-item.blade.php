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
                        <button 
                            id="delete-task-btn" 
                            type="submit"
                            onclick="event.preventDefault(); if (confirm('are you sure?')) this.closest('form').submit();"
                        >
                            Delete
                        </button> 
                    </form>                  
                </li>
                <li>
                    <a>Rating</a>

                    <div class="select-color-modal">
                        <form class="form__color-block" action="{{ route('tasks.update', $task) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="user_id" value="{{ $task->user_id }}" />
                            <input type="hidden" name="title" value="{{ $task->title }}" />

                            @foreach(App\Enum\Rates::RATES as $key=>$rate)
                                <input 
                                    id="rate-color-{{ $key }}" 
                                    type="radio" 
                                    name="rate" 
                                    class="{{ $rate }}" 
                                    value="{{ $key }}"
                                    @if(isset($task) && $task->rate == $key)
                                        checked
                                    @elseif(!isset($task) && $key == 5)
                                        checked
                                    @endif
                                    onclick="this.closest('form').submit();"
                                />
                                <label for="rate-color-{{ $key }}" class="{{ $rate }}"></label>
                            @endforeach
                        </form>
                    </div>
                </li>
            </ul> 
        </div>
    </div>

</li>



