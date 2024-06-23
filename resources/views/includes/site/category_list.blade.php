<ul class="category-list">
    @foreach ($categories as $category)
        <li>            
            <a 
                class="category-list__item" 
                href="{{ route('category', $category->id) }}"
            >
                {{ $category->category_name }}
            </a>           
        </li>
    @endforeach
</ul>
