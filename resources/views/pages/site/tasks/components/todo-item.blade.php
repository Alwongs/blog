<li class="todo-list__item todo-item {{ App\Enum\Rates::RATES[$task->rate] }}">

    <a class="todo-item__title" href="{{ route('tasks.show', $task->id) }}" >&bull; {{$task->title}}</a>

    <div class="todo-item__actions">
        <i class="three-dots-icon"></i>

        <div class="todo-item__modal hidden">
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
                    <a id="select-color-modal-opener-{{ $task->id }}" data-task="{{ $task->id }}" class="select-color-modal-opener">Rating</a>

                    <div id="select-color-modal-{{ $task->id }}" class="select-color-modal hidden">
                        <form id="select-color-form-{{ $task->id }}" class="form__color-block" action="{{ route('tasks.update', $task) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="user_id" value="{{ $task->user_id }}" />
                            <input type="hidden" name="title" value="{{ $task->title }}" />
                            <input type="hidden" name="description" value="{{ $task->description }}" />
                            <input type="hidden" name="position" value="{{ $task->position }}" />
                            <input type="hidden" name="status" value="{{ $task->status }}" />

                            @foreach(App\Enum\Rates::RATES as $key=>$rate)
                                <input 
                                    id="task-{{ $task->id }}-rate-color-{{ $key }}" 
                                    data-type="color-label" 
                                    type="radio" 
                                    name="rate" 
                                    class="{{ $rate }} input-radio-color" 
                                    value="{{ $key }}"
                                    @if(isset($task) && $task->rate == $key)
                                        checked
                                    @elseif(!isset($task) && $key == 5)
                                        checked
                                    @endif
                                    onclick="this.closest('form').submit();"
                                />
                                <label data-type="color-label"  for="task-{{ $task->id }}-rate-color-{{ $key }}" class="{{ $rate }}"></label>
                            @endforeach                          
                        </form>
                    </div>
                </li>
            </ul> 
        </div>
    </div>

</li>

