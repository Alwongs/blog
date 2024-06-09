<x-site-layout>

    <section class="page-banner">
        <h2 class="home-title">{{ $post->title }}</h2>
    </section>

    <section class="container">
        @include('includes.site.breadcrumbs', ['category' => $post->category])
    </section>

    <section class="section">
        <div class="page-container photo-detail">
            <h3 class="photo-detail__title">{{ $post->title }}</h3>
            <div class="photo-detail__body">
                <div class="photo-detail__image">
                    @if ($post->image)
                        <img 
                            src="{{ Storage::url('posts/' . App\Helpers\TextHelper::transliterate($post->category->title) . '/previews/' . $post->image) }}" 
                            alt="{{ $post->image }}" 
                            title="{{ $post->title }}"
                        />
                    @else
                        <div class="no-photo-image"></div>
                    @endif
                </div>
                
                <div class="text-container photo-detail__text">
                    {{ $post->description }}
                </div>
                @if (!empty($post->source_link))
                    <div class="text-container photo-detail__source-link">
                        <a href="{{ $post->source_link }}" target="_blank" >{{ __("blog.source_link")}}</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-site-layout>