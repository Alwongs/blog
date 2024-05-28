<x-admin-layout>
    @include('includes.common.notification')

    <main class="main">
        <div class="add-btn-group">
            <a class="add-btn btn-icon-add" title="add new post" href="{{ route('categories.create') }}"></a>
        </div> 

        @if(count($categories) != 0)
            <ul class="manage-list">
                @foreach($categories as $category)
                <li class="manage-list__item">
                    <div class="manage-list__item-image">
                        @if($category->image)
                            <img src="{{ Storage::url('categories/icons/' . $category->image) ?: '' }}" alt="{{ $category->image }}" />
                        @else
                            <div class="no-photo-image"></div>
                        @endif
                    </div>  

                    <div class="manage-list__item-title">{{ $category->title }}</div> 

                    <div class="manage-list__item-date">{{ date("d.m.Y", strtotime($category->created_at)) }}</div>

                    <a href="{{ route('categories.edit', $category->id) }}" class="cell-btn btn-icon-edit"></a>

                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
            {{ $categories->links() }}
        </div>

    </main>

</x-admin-layout>
