@php
    $types = [
        "T" => "text",
        "C" => "checkbox"
    ];
@endphp

<x-admin-layout>
    @include('includes.common.notification')
    
    <main class="main">
        <section class="section">
            <form class="form" action="{{ route('settings.update', 1) }}" method="POST">
                @method('PUT')
                @csrf

                @if(count($settings) > 15)
                    <div class="form__btn-block">
                        <button type="submit" class="btn btn-green submit">
                            @if(isset($album))
                                Update
                            @else
                                Save
                            @endif
                        </button>
                    </div> 
                @endif                             

                @if(count($settings) != 0)
                    <ul class="manage-list">
                        @foreach($settings as $setting)
                            <li class="manage-list__item">
                                <div class="manage-list__item-title">
                                    {{ __("settings.$setting->code") }}
                                </div>

                                <div class="manage-list__item-value">
                                    <input 
                                        name="settings[{{ $setting->code }}]" 
                                        value="{{ $setting->value }}"
                                        type="{{ $types[$setting->type] }}"
                                        @if($setting->type == 'C' && $setting->value == "Y") checked @endif
                                    />
                                </div> 
                            </li>        
                        @endforeach
                    </ul>  
                    
                    <div class="form__btn-block">
                        <button type="submit" class="btn btn-green submit">
                            @if(isset($album))
                                Update
                            @else
                                Save
                            @endif
                        </button>
                    </div>
                @else
                    <p style="color:grey;text-align:center">{{ __("settings.make_settings_migration") }}</p>
                @endif        
            </form>
        </section>

        <section class="section dashboard-actions">
            <h2 class="dashboard-actions__title">
                {{ __("dashboard.actions") }}
            </h2>
            <ul class="dashboard-actions__body">
                @if (auth()->user()->is_root)
                    <li class="dashboard-actions__item">
                        <form action="{{ route('remove-categories') }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="dashboard-actions__action" onclick="confirm('All Categories and Posts will be removed from database and file system!')">
                                {{ __("dashboard.clear_blog_db_and_storage") }}
                            </button>
                        </form>
                    </li>
                    
                    <li class="dashboard-actions__item">
                        <form action="{{ route('remove-events') }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="dashboard-actions__action bg-red" onclick="confirm('Are you ready to remove all categories and posts!')">
                                {{ __("dashboard.clear_events") }}
                            </button>
                        </form>
                    </li>

                    <li class="dashboard-actions__item">
                        <form action="{{ route('clear-schedule-days') }}" method="POST">
                            @csrf
                            <button type="submit" class="dashboard-actions__action bg-red" onclick="confirm('Are you ready to clear the schedule days?')">
                                {{ __("dashboard.clear_schedule_days") }}
                            </button>
                        </form>
                    </li>                     

                    <li class="dashboard-actions__item">
                        <form action="{{ route('add-new-thumbnails') }}" method="POST">
                            @csrf
                            <button type="submit" class="dashboard-actions__action bg-green" onclick="confirm('Are you ready to create new thumbnails!')">
                                {{ __("dashboard.add_new_thumbnails") }}
                            </button>
                        </form>
                    </li>

                @endif
            </ul>
        </section>
    </main>
</x-admin-layout>
