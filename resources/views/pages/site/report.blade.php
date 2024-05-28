<x-site-layout>
    <section class="page-banner">
        <h2 class="home-title">{{ __('message.contact_us') }}</h2>
    </section>

    @include('includes.common.notification')

    <section class="main page-container">
        <h2 class="main__title">Thank you! Message has been sent</h2>

        <div class="btn-block">
            <a href="{{ route('home') }}" class="btn">Home</a>
        </div>

    </section>
</x-site-layout>