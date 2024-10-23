<x-site-layout>
    <section class="page-banner">
        <h2>{{ __('time_management.new_manage_day') }}</h2>
    </section>

    @include('includes.common.notification')

    <main class="main  todo-section">
        @if(isset($manage_day))
            <form class="form" action="{{ route('manage-days.update', $manage_day) }}" method="POST">
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $manage_day->user_id }}" />
        @else
            <form class="form" action="{{ route('manage-days.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ $user_id }}" />
        @endif
            @csrf

            <div class="form__input-block">
                <input name="title" type="text" placeholder="title" value="{{ isset($manage_day) ? $manage_day->title : '' }}" required  autofocus />
            </div>    

            <div class="form__btn-block">
                <button type="submit" class="btn btn-green btn-save">
                    @if(isset($manage_day))
                        Update
                    @else
                        Save
                    @endif
                </button>              
            </div>

        </form>

        <div class="divider"></div>

        <div class="product-list-detail-btn-block">
            <a class="product-list-detail-btn btn-grey" href="{{ route('product-lists.index') }}">Back</a>

            @if(isset($manage_day))
                <form class="product-list-detail-btn btn-red" action="{{ route('product-lists.destroy', $manage_day->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button id="clear-manage_days-btn" class="btn-red" type="submit">Delete</button> 
                </form> 
            @endif
        </div> 

    </main>

</x-site-layout>


