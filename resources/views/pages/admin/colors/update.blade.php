<x-admin-layout>
    <header class="header">
        <h1>@isset($color){{ __('ideas.update') }}@else{{ __('colors.new_color') }}@endisset</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($color))
            <form class="form" action="{{ route('colors.update', $color) }}" method="POST">
                @method('PUT')
        @else
            <form class="form" action="{{ route('colors.store') }}" method="POST">
        @endif
            @csrf

            <div class="form__input-block">
                <input name="position" type="text" placeholder="position" value="{{ isset($task) ? $task->position : '0' }}" required  />
            </div>  
            
            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($color) ? $color->title : '' }}"/>
            </div>  

            @if(isset($color))
                <div class="form__input-block">
                    <input name="" type="text" value="{{ isset($color) ? $color->color : '' }}" disabled/>
                </div>  
            @endif  

            <div class="form__input-color-block">
                <input name="color" type="color" value="{{ isset($color) ? $color->color : '#0f0' }}" required />
            </div>             

            
            <div class="form__status-block">
                @foreach(App\Enum\Status::STATUSES as $key=>$status)
                    <input 
                        id="status-{{ $status }}" 
                        type="radio" 
                        name="status" 
                        class="product-status-{{ $status }}" 
                        value="{{ $key }}"
                        @if(isset($color) && $color->status == $key)
                            checked
                        @elseif(!isset($color) && $key == 'A')
                            checked
                        @endif
                    />
                    <label for="status-{{ $status }}" class="{{ $status }}">{{ $status }}</label>
                @endforeach
            </div> 

            <div class="divider"></div>

            <div class="form__btn-block">
                <a class="btn btn-grey" href="{{ route('colors.index') }}">Back</a>
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($color))
                        Update
                    @else
                        Save
                    @endif
                </button>
            </div>
        </form>        

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
</x-admin-layout>


