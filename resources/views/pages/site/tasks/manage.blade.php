<x-site-layout>

    <section class="page-banner">
        <h2>To Do List</h2>
    </section>

    <section class="section">
        <div class="todo-list-container">

            <div class="todo-list-btn-block">
                <a title="add new task" href="{{ route('tasks.create') }}">&#10010;</a>
                <form action="{{ route('clear-tasks') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-link btn-red" type="submit">Очистить</button> 
                </form> 
            </div> 

            @if(count($tasks) > 0)
                <ul class="todo-list">
                    @foreach($tasks as $task)
                        @include("pages.site.tasks.components.todo-item")
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("tasks.no_tasks") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>