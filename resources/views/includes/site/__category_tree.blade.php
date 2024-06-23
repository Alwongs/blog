<ul class="category-tree">
    @foreach ($categories as $category)
        <li>
            @if (count($category->childrenCategories) == 0)
                <span class="category-tree__list-opener empty" style="color:transparent;">-</span>
            @else
                <span class="category-tree__list-opener">+</span>
            @endif
            
            <a class="category-tree__root-category" href="{{ route('category', $category->id) }}">{{ $category->title }}</a>

            <ul class="category-tree__sub-list">
                @foreach ($category->childrenCategories as $childCategory)
                    @include('my-components.child_category', ['child_category' => $childCategory])
                @endforeach
            </ul>            
        </li>
    @endforeach

</ul>

@push('jquery')
    <script src="{{ asset('js/jquery-3.7.0.slim.min.js') }}"></script>
    <script>
        $('.category-tree li > span').on('click', function(e) {
            e.stopPropagation();
            var subList = $(this).parent().children('.category-tree__sub-list');
            if (subList.hasClass('open')) {
                $(this).parent().find('.category-tree__sub-list').removeClass('open');
                $(this).html("+");
            } else {
                subList.addClass('open');
                $(this).html("-");
            }
        });
    </script>
@endpush