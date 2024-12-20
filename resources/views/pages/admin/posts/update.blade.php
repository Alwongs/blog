<x-admin-layout>
    <header class="header">
        <h1>@isset($post){{ __('blog.update') }}@else{{ __('blog.new_post') }}@endisset</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($post))
            <form class="form" action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            
            <div class="form__input-block">
                @if($categories)
                    <select name="category_id" id="album" required>
                        <option value="" >Select Album</option>
                        @foreach($categories as $category)
                            @if(isset($post) && $category->id == $post->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <p style="color:red;">Create at least one album</p>
                @endif
            </div>  

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($post) ? $post->title : '' }}" required />
            </div>    

            <div class="form__textarea-block">
                <textarea id="mytextarea" name="description" placeholder="description">{{ isset($post) ? $post->description : '' }}</textarea>
            </div>

            <div class="form__input-block">
                <input name="source_link" type="text" placeholder="{{ __("blog.source_link") }}" value="{{ isset($post) ? $post->source_link : '' }}" />
            </div> 

            @isset($post)
                <div class="form__image-block">
                    @if($post->image)
                        <img src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/previews/' . $post->image) ?: '' }}" alt="{{ $post->image }}" />
                    @else
                        <div class="no-photo-image"></div>
                    @endif
                </div>
            @endisset

            <!-- For file size validation make js check -->
            <div class="form__file-block">
                <input 
                    id="input_file"
                    name="image"
                    type="file"
                />
                <p id="error" style="color: red;"></p>
            </div>  

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($post))
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


