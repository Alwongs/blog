<li class="category-card">
    <a class="category-card__link" href="{{ route('category', $category->id) }}">
        <h3 class="category-card__title">{{ $category->category_name }}</h3>
        @if ($category->image)
            <img src="{{ Storage::url('categories/previews/' . $category->image) }}" alt="{{ $category->image }}" title="{{ $category->title }}" />
        @else
            <div class="no-photo-image"></div>
        @endif
    </a>
</li>