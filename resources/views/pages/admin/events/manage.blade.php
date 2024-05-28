<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">
        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new post" href="{{ route('events.create') }}?return_url=events.index"></a>
        </div> 

        @if(count($events) != 0)
            <ul class="manage-list">
                @foreach($events as $event)
                    <li class="manage-list__item">
                        <div class="manage-list__item-date">{{ date('d.m.Y', $event->timestamp); }}</div>

                        <div class="manage-list__item-title">{{ $event->event }}</div> 

                        <div class="manage-list__item-type">
                            @if ($event->type == "U")
                                unique
                            @elseif ($event->type == "M")
                                monthly
                            @elseif ($event->type == "A")
                                annual
                            @endif
                        </div>

                        <a href="{{ route('events.edit', $event->id) }}" class="cell-btn btn-icon-edit"></a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button href="{{ route('events.destroy', $event->id) }}" class="cell-btn btn-icon-delete"></button> 
                        </form>     
                    </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif                  

        <div class="pagination-block">
            {{ $events->links() }}
        </div>
    </main>

</x-admin-layout>
