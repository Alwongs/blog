<li class="blog-page-item">
    <div class="blog-page-item__content">
        <div class="blog-page-item__image">
            <a class="" href="{{ route('post', $post->id) }}">
                @if ($post->image)
                    <img 
                        src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/previews/' . $post->image) }}" 
                        alt="{{ $post->image }}" 
                        title="{{ $post->title }}"
                    />
                @else
                    <div class="no-photo-image"></div>
                @endif
            </a>
        </div>
        <div class="blog-page-item__text">
            <div class="blog-page-item__header">
                <h3 class="blog-page-item__title">{{ $post->title }}</h3>
            </div>
            <p class="blog-page-item__description">{{ $post->description }}</p>
            <a class="blog-page-item__footer" href="{{ route('post', $post->id) }}">{{ __("common.read_more") }}</a>
        </div>
    </div>
</li>
