<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">
        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new post" href="{{ route('colors.create') }}"></a>
        </div> 

        @if(count($colors) != 0)
            <ul class="color-list">
                @foreach($colors as $color)
                <li class="color-list__item" style="background-color:{{ $color->color }}"> 

                    <div class="color-list__item-title">
                        <a href="{{ route('colors.edit', $color->id) }}">
                            {{ $color->title }}
                        </a>
                    </div> 

                    <div class="color-list__item-actions">
                        <a href="{{ route('colors.edit', $color->id) }}" class="color-list__action-btn btn-icon-edit"></a>
                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST" class="color-list__action-btn">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon-delete"></button> 
                        </form>    
                    </div> 
                </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif

        <div class="pagination-block">
            {{ $colors->links() }}
        </div>

    </main>

</x-admin-layout>
