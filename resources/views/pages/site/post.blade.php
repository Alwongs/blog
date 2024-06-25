<x-site-layout>

    <section class="page-banner">
        <h2 class="home-title">{{ $post->title }}</h2>
    </section>

    <section class="container">
        @include('includes.site.breadcrumbs', ['category' => $post->category])
    </section>

    <section class="section">
        <div class="page-container post-detail">

            <div class="category-tree-column">
                @include('includes.site.category_list', ['categories' => $categories])
            </div>

            <div class="post-detail-column">
                <h3 class="post-detail__title">{{ $post->title }}</h3>
                <div class="post-detail__body">

                    @if ($post->image)
                        <div class="post-detail__image">
                            <img 
                                src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/previews/' . $post->image) }}" 
                                alt="{{ $post->image }}" 
                                title="{{ $post->title }}"
                            />
                        </div>
                    @endif

                    
                    <div class="text-container post-detail__text tinymce-content">
                        {!! $post->description !!}
                    </div>
                    @if (!empty($post->source_link))
                        <div class="text-container post-detail__source-link">
                            <a href="{{ $post->source_link }}" target="_blank" >{{ __("blog.source_link")}}</a>
                        </div>
                    @endif
                </div>
                @include('blocks.comments')
            </div>    

            <div class="search-column">
                @include('includes.site.search')
            </div>                        
        </div>
    </section>

</x-site-layout>