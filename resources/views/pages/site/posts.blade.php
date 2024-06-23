<x-site-layout>
    <section class="page-banner">
        <h2>{{ __("common.search") . ": " . $phrase }}</h2>
    </section>

    <section class="container">
        @include('includes.site.breadcrumbs')
    </section>

    <section class="section">
        <div class="page-container category-posts">
            <div class="category-tree-column">
                @include('includes.site.category_list', ['categories' => $categories])
            </div>
        
            <div class="category-posts-main-column">
                @if(count($posts) != 0)
                    <ul class="post-list">
                        @foreach ($posts as $post)
                            @include('cards.post')
                        @endforeach
                    </ul> 
                @else
                    <p class="empty-list-note">{{ __("blog.no_posts_in_category") }}</p>
                @endif

                <div class="pagination-block">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="search-column">
                @include('includes.site.search')
            </div>               
        </div>
    </section>

</x-site-layout>