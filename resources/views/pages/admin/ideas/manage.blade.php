<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">
        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new post" href="{{ route('ideas.create') }}"></a>
        </div> 

        @if(count($ideas) != 0)
            <ul class="manage-list">
                @foreach($ideas as $idea)
                <li class="manage-list__item"> 

                    <div class="manage-list__item-title">
                        <a href="{{ route('ideas.edit', $idea->id) }}">
                            {{ $idea->title }}
                        </a>
                    </div> 

                    <a href="{{ route('ideas.edit', $idea->id) }}" class="cell-btn btn-icon-edit"></a>
                    <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cell-btn btn-icon-delete"></button> 
                    </form>     
                </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif

        <div class="pagination-block">
            {{ $ideas->links() }}
        </div>

    </main>

</x-admin-layout>
