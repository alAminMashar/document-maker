<div>
    @include('livewire.dashboard.components.cards')

    <div>
        <hr>
    </div>

    <div class="row">
        @if (auth()->user()->can('user.store'))
            @include('livewire.dashboard.users.table')
        @endif

        @if (auth()->user()->can('users'))
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        {!! $users_chart->renderHtml() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    {!! $users_chart->renderChartJsLibrary() !!}
    {!! $users_chart->renderJs() !!}
@endpush
