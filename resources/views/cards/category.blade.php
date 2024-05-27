<li class="album-card">
    <a class="album-card__link" href="{{ route('category', $category->id) }}">
        <h3 class="album-card__title">{{ $category->title }}</h3>
        @if ($category->image)
            <img src="{{ Storage::url('categories/previews/' . $category->image) }}" alt="{{ $category->image }}" title="{{ $category->title }}" />
        @else
            <div class="no-photo-image"></div>
        @endif
    </a>
</li>