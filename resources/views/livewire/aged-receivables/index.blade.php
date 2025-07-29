<div>
    @if ($showAgedAccountModal)
        @include('livewire.customer.includes.aged-report-modal')
    @endif

    @include('livewire.aged-receivables.components.search')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Aged Receivables
                </h4>
                <p class="card-description">
                    @if ($filter)
                        <br>
                        <small class="text-secondary">
                            <b class="text-muted">({{ number_format($result_count) . ' results' }})</b>
                            {{ $filter_description }}
                        </small>
                    @endif
                </p>

                @if (auth()->user()->can('aged-receivables.report'))
                    <button wire:click="openReportModal()" class="btn btn-info btn-sm float-right">
                        <i class="mdi mdi-checkbox-marked-outline"></i>
                        Aged Receivables
                    </button>
                @endif
                <br>
                <br>
                @include('livewire.aged-receivables.components.index-table')
            </div>
        </div>
    </div>
</div>
