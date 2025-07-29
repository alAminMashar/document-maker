<div>

    @include('livewire.aged-receivables.components.show-search')

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
                    Aged from {{ date_format(new DateTime($start_date), 'F j, Y') }}
                </p>
                @include('livewire.aged-receivables.components.show-table')
            </div>
        </div>
    </div>
</div>
