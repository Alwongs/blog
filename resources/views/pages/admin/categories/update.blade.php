<x-admin-layout>
    <header class="header">
        <h1>@isset($category){{ __('blog.update') }}@else{{ __('blog.new_category') }}@endisset</h1>
    </header>

    <main class="main">

        @include('includes.common.notification')

        @if(isset($category))
            <form class="form" action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form__input-block">
                <input 
                    type="text"
                    name="title"
                    placeholder="title"
                    value="{{ isset($category) ? $category->title : '' }}"
                    @if(isset($category)) 
                        class="input-disabled"
                        disabled
                    @else
                        required
                    @endif
                />
            </div>    

            <div class="form__textarea-block">
                <textarea name="description" placeholder="description">{{ isset($category) ? $category->description : '' }}</textarea>
            </div>

            @isset($category)
                <div class="form__image-block">
                    @if($category->image)
                        <img src="{{ Storage::url('categories/previews/' . $category->image) ?: '' }}" alt="{{ $category->image }}" />
                    @else
                        <div class="no-photo-image"></div>
                    @endif
                </div>
            @endisset

            <div class="form__file-block">
                <input 
                    id="input_file" 
                    name="image" 
                    type="file"
                    @if(!isset($category)) 
                        required
                    @endif
                />
                <p id="error" style="color: red;"></p>
            </div>  



            <div class="form__btn-block">
                <button type="submit" class="btn btn-green submit">
                    @if(isset($category))
                        Update
                    @else
                        Save
                    @endif
                </button>
            </div>
        </form>

    </main>

</x-admin-layout>


