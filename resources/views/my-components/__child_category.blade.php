<li>
    @if (count($child_category->categories) == 0)
        <span class="category-tree__list-opener empty" style="color:transparent;">-</span>
    @else
        <span class="category-tree__list-opener">+</span>
    @endif
    
    <a href="{{ route('category', $child_category->id) }}">{{ $child_category->title }}</a>

    @if ($child_category->categories)
        <ul class="category-tree__sub-list">
            @foreach ($child_category->categories as $childCategory)
                @include('my-components.child_category', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endif
</li>
