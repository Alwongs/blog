<x-site-layout>
    
    <section class="page-banner">
        <h2 class="home-title">{{ __("blog.categories") }}</h2>
    </section>

    <section class="container">
        @include('includes.site.breadcrumbs')
    </section>

    <section class="section">
        <div class="page-container">
            @if(count($categories) != 0)
                <ul class="gallery-list">
                    @foreach ($categories as $category)
                        @include('cards.category')
                    @endforeach
                </ul>
            @else
                <p class="empty-list-note">{{ __("blog.no_categories") }}</p>
            @endif

            <div class="pagination-block">
                {{ $categories->links() }}
            </div>
        </div>
    </section>

</x-site-layout>