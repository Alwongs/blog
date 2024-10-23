<x-site-layout>
    <section class="page-banner">
        <h2>{{ __('tasks.new_task') }}</h2>
    </section>

    @include('includes.common.notification')

    <main class="main  todo-section">
        @if(isset($task))
            <form class="form" action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}" />

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($task) ? $task->title : '' }}" required autofocus />
            </div>    

            <div class="form__color-block">
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
                    />
                    <label for="rate-color-{{ $key }}" class="{{ $rate }}"></label>
                @endforeach
            </div> 


            <div class="form__textarea-block">
                <textarea id="mytextarea" name="description" placeholder="description">{{ isset($task) ? $task->description : '' }}</textarea>
            </div> 

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($task))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>

        </form>

        <div class="divider"></div>

        <div class="task-detail-btn-block">
            <a class="task-detail-btn btn-grey" href="{{ route('tasks.index') }}">Back</a>

            @if(isset($task))
                <form class="task-detail-btn btn-red" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="clear-tasks-btn" class="btn-red" type="submit">Delete</button> 
                </form> 
            @endif
        </div> 

    </main>

    @push('tinymce')
        <script 
            src="https://cdn.tiny.cloud/1/81udwibp5bnpl1hfw94bct46jrb2sxrc01vkn1abbktr17jn/tinymce/7/tinymce.min.js" 
            referrerpolicy="origin"
        ></script>
        <script>
            tinymce.init({
                selector: '#mytextarea',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code '
            });
        </script>
    @endpush

</x-site-layout>


