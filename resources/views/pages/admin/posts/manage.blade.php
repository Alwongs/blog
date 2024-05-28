<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">
        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new post" href="{{ route('posts.create') }}"></a>
        </div> 

        @if(count($posts) != 0)
            <ul class="manage-list">
                @foreach($posts as $post)
                <li class="manage-list__item">
                    <div class="manage-list__item-image">
                        @if($post->image)
                            <img src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/icons/' . $post->image) ?: '' }}" alt="{{ $post->image }}" />
                        @else
                            <div class="no-photo-image"></div>
                        @endif
                    </div>  

                    <div class="manage-list__item-title">{{ $post->title }}</div> 

                    <div class="manage-list__item-date">{{ date("d.m.Y", strtotime($post->created_at)) }}</div>

                    <a href="{{ route('posts.edit', $post->id) }}" class="cell-btn btn-icon-edit"></a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cell-btn btn-icon-delete"></button> 
                    </form>     
                </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif

        <div class="pagination-block">
            {{ $posts->links() }}
        </div>

    </main>

</x-admin-layout>
