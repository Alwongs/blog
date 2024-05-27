<x-site-layout>

    <section class="page-banner">
        <h2>{{ $category->title }}</h2>
    </section>

    <section class="container">
        @include('includes.site.breadcrumbs', ['category' => $category])
    </section>

    <section class="section">
        <div class="page-container ">
        
            @if(count($posts) != 0)

                <ul class="gallery-list-vertical">
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
    </section>

</x-site-layout>