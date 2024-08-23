<x-site-layout>

    @include('includes.common.notification')

    <section class="section">
        <div class="page-container task-detail">


            <h3 class="post-detail__title">{{ $task->title }}</h3>

            <div class="post-detail__body">
                <div class="text-container post-detail__text tinymce-content">
                    {!! $task->description !!}
                </div>
            </div>

            <div class="btn-group">
                <a class="btn" href="{{ route('tasks.index') }}">Back</a>
            </div>
                         
        </div>
    </section>

</x-site-layout>


