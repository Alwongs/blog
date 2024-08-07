<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">

        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new task" href="{{ route('tasks.create') }}?return_url=tasks.index"></a>
        </div> 

        @if(count($tasks) != 0)
            <ul class="manage-list">
                @foreach($tasks as $task)
                    <li class="manage-list__item">

                        <div class="manage-list__item-title">{{ $task->title }}</div> 

                        <a href="{{ route('tasks.edit', $task->id) }}" class="cell-btn btn-icon-edit"></a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button href="{{ route('tasks.destroy', $task->id) }}" class="cell-btn btn-icon-delete"></button> 
                        </form>     
                    </li>        
                @endforeach
            </ul>  
        @else
            <p style="color:grey;text-align:center">{{ __("common.array_is_empty") }}</p>
        @endif                  

    </main>

</x-admin-layout>
