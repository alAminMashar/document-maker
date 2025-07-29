<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Period</th>
            <th>Reports</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($active_periods as $period)
            @include('livewire.aged-receivables.includes.index-row')
        @endforeach
    </tbody>
</table>
<br><br>
<div class="row">
    <div class="col">
        {{ $active_periods->links() }}
    </div>
</div>
