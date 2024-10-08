<x-site-layout>

    <section class="page-banner">
        <h2>{{ $task->title }}</h2>
    </section>

    <section class="section todo-section">
        <div class="page-container task-detail">

            <fieldset class="task-detail__fieldset">

                <h3 class="task-detail__title">{{ $task->title }}</h3>

                <div class="task-detail__body">
                    <div class="text-container task-detail__text tinymce-content">
                        {!! $task->description !!}
                    </div>
                </div>

            </fieldset>

            <div class="task-detail-btn-block">
                <a class="task-detail-btn btn-grey" href="{{ route('tasks.index') }}">Back</a>

                <a class="task-detail-btn btn-blue" href="{{ route('tasks.edit', $task->id) }}">Edit</a>

                <form class="task-detail-btn" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-tasks-btn" class="task-detail-btn btn-red" type="submit">Delete</button> 
                </form> 
            </div>
                         
        </div>
    </section>

</x-site-layout>


