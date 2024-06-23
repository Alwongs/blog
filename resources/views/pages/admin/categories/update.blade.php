<x-admin-layout>
    <header class="header">
        <h1>@isset($category){{ __('blog.update') }}@else{{ __('blog.new_category') }}@endisset</h1>
    </header>

    @include('includes.common.notification')

    <main class="main">
        @if(isset($category))
            <form class="form" action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="form" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form__input-block">
                <input 
                    type="number"
                    name="position"
                    placeholder="position"
                    value="{{ isset($category) ? $category->position : 0 }}"
                />
            </div>

            <div class="form__input-block">
                <input 
                    type="text"
                    name="category_name"
                    placeholder="category name"
                    value="{{ isset($category) ? $category->category_name : '' }}"
                />
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
                <input id="input_file" name="image" type="file" @if(!isset($category)) required @endif />
                <p id="error" style="color: red;"></p>
            </div>  

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green submit"> @if(isset($category)) Update @else Save @endif </button>
            </div>
        </form>

    </main>

</x-admin-layout>


