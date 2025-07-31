<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Amount Due</th>
            <th>{{ $period_current }}</th>
            <th>{{ $period_30 }}</th>
            <th>{{ $period_60 }}</th>
            <th>{{ $period_90 }}</th>
            <th>Over 120 Days</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
            @include('livewire.aged-receivables.includes.show-row')
        @endforeach
    </tbody>
</table>
<br><br>
<div class="row">
    <div class="col">
        {{ $accounts->links() }}
    </div>
</div>
