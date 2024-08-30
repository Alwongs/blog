<x-site-layout>

    <section class="page-banner">
        <h2>To Do List</h2>
    </section>

            @include('includes.common.notification')

    <section class="section todo-section">
        <div class="todo-list-container">

            <div class="todo-list-btn-block">
                <a title="add new task" href="{{ route('tasks.create') }}">+</a>
            </div> 

            @if(count($tasks) > 0)
                <ul class="todo-list">
                    @foreach($tasks as $task)
                        @include("pages.site.tasks.components.todo-item")
                    @endforeach
                </ul>

                <form class="btn-block" action="{{ route('clear-tasks') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-tasks-btn" class="clear-tasks-btn" type="submit">Clear</button> 
                </form> 
            @else
                <p class="empty-list-note">{{ __("tasks.no_tasks") }}</p>
            @endif

        </div>
    </section>

</x-site-layout>