<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <thead>
            <tr>
                <th>#</th>
                <th>Activity</th>
                <th>Details</th>
                <th>Happened On</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                @include('livewire.activity-logs.includes.item-row', $log)
            @endforeach
        </tbody>
    </table>
</div>
