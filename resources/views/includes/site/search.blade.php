<div class="search-posts-block">
    <form action="{{ route('search-phrase') }}" class="search-form" method="GET">
        <div class="search-posts-block__input-block">
            <input type="text" name="search_phrase" placeholder="Search">
        </div>
        <div class="search-posts-block__btn-block">
            <button type="submit">Find</button>
        </div>
    </form>
</div>