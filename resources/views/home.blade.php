<x-site-layout>

    <section class="home-page-banner">
        <h2>{{ __("blog.my_blog") }}</h2>
        <a class="home-page-banner__contact-us" href="{{ route('contact-us') }}">
            {{ __("message.contact_us") }}
        </a>
    </section>


    <section class="section">
        <div class="container">
            <x-section-title>
                {{ __("blog.recent_posts") }}
            </x-section-title>

            @include('blocks.recent_posts')

            <div class="btn-block">
                <a href="{{ route('blog') }}" class="btn">{{ __("btn.all_posts") }}</a>
            </div>            
        </div>
    </section>         

</x-site-layout>
