<x-admin-layout>
    <div class="dashboard">
        @include('includes.common.notification')

        <div class="dashboard-container">

            <section class="reminder-section">
                <div class="add-btn-group">
                    <a class="add-btn btn-icon-add" title="add new event" href="{{ route('events.create') }}?return_url=dashboard"></a>
                </div>
    
                <div class="dashboard-row">  
                    <x-dashboard-card :events="$overdue" :title="'overdue'" :class="'overdue'" :count="''" />
                    <x-dashboard-card :events="$today" :title="'today'" :class="'today'" :count="$tasksCount" />
                    <x-dashboard-card :events="$tomorrow" :title="'tomorrow'" :class="'tomorrow'" :count="''" />
                </div>

                <div class="dashboard-row-second">
                    <x-dashboard-card :events="$in_week" :title="'in week'" :class="'in-week'" :count="''" />
                </div>
            </section>

        </div>
    </div>

</x-admin-layout>
