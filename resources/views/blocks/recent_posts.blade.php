@php 
    use App\Helpers\TextHelper; 
@endphp

@isset($posts)
    <ul class="recent-photos-block">
        @foreach ($posts as $post)
            <li class="photo-card">
                <h3 class="photo-card__title">{{ $post->title }}</h3>
                <a class="photo-card__image" href="{{ route('post', $post->id) }}">
                    @if ($post->image)
                        <img 
                            src="{{ Storage::url('posts/' . TextHelper::transliterate($post->category->title) . '/previews_small/' . $post->image) }}" 
                            alt="{{ $post->image }}" 
                            title="{{ $post->title }}"
                        />
                    @else
                        <div class="no-photo-image"></div>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
@endisset