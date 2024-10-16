<x-admin-layout>
    <header class="header">
        <h1>@isset($idea){{ __('ideas.update') }}@else{{ __('ideas.new_idea') }}@endisset</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($idea))
            <form class="form" action="{{ route('ideas.update', $idea) }}" method="POST">
                @method('PUT')
        @else
            <form class="form" action="{{ route('ideas.store') }}" method="POST">
        @endif
            @csrf

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($idea) ? $idea->title : '' }}" required />
            </div>    

            <div class="form__textarea-block">
                <textarea id="mytextarea" name="description" placeholder="description">{{ isset($idea) ? $idea->description : '' }}</textarea>
            </div>

            
            <div class="form__status-block">
                @foreach(App\Enum\Status::STATUSES as $key=>$status)
                    <input 
                        id="status-{{ $status }}" 
                        type="radio" 
                        name="status" 
                        class="product-status-{{ $status }}" 
                        value="{{ $key }}"
                        @if(isset($idea) && $idea->status == $key)
                            checked
                        @elseif(!isset($idea) && $key == 'A')
                            checked
                        @endif
                    />
                    <label for="status-{{ $status }}" class="{{ $status }}">{{ $status }}</label>
                @endforeach
            </div> 

            <div class="form__color-block">
                @foreach(App\Enum\Rates::RATES as $key=>$rate)
                    <input 
                        id="rate-color-{{ $key }}" 
                        type="radio" 
                        name="rate" 
                        class="{{ $rate }}" 
                        value="{{ $key }}"
                        @if(isset($idea) && $idea->rate == $key)
                            checked
                        @elseif(!isset($idea) && $key == 5)
                            checked
                        @endif
                    />
                    <label for="rate-color-{{ $key }}" class="{{ $rate }}"></label>
                @endforeach
            </div> 


            <div class="form__btn-block">
                <button type="submit" class="btn btn-green">
                    @if(isset($idea))
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


