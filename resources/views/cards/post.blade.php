<li class="blog-page-item">
    <div class="blog-page-item__image">
        <a class="blog-page-item__link" href="{{ route('post', $post->id) }}">
            @if ($post->image)
                <img 
                    src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/icons/' . $post->image) }}" 
                    alt="{{ $post->image }}" 
                    title="{{ $post->title }}"
                />
            @else
                <div class="no-photo-image"></div>
            @endif
        </a>
    </div>
    <div class="blog-page-item__text">
        <a class="blog-page-item__link" href="{{ route('post', $post->id) }}">
            <h3 class="blog-page-item__title">{{ $post->title }}</h3>
        </a> 
    </div>
</li>
