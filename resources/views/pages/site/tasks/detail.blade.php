<x-site-layout>

    <section class="section">
        <div class="page-container task-detail">

            <h3 class="task-detail__title">{{ $task->title }}</h3>

            <div class="task-detail__body">
                <div class="text-container task-detail__text tinymce-content">
                    {!! $task->description !!}
                </div>
            </div>

            <div class="btn-group">
                <a class="btn" href="{{ route('tasks.index') }}">Back</a>
            </div>
                         
        </div>
    </section>

</x-site-layout>


