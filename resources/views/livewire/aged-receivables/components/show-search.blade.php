<div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffCanvas" aria-labelledby="searchOffCanvasLabel">
    <div class="offcanvas-header">
        <h5 id="searchOffCanvasLabel">Filter Receivable Reports</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form class="forms-sample row">

                <div class="form-group col-6">
                    <label for="filter_balance_min">Minimum Balance</label>
                    <input type="number" class="form-control @error('filter_balance_min') is-invalid @enderror"
                        id="filter_balance_min" placeholder="Minimum" wire:model.defer="filter_balance_min" value=0>
                    @error('filter_balance_min')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label for="filter_balance_max">Maximum Balance</label>
                    <input type="number" class="form-control @error('filter_balance_max') is-invalid @enderror"
                        id="filter_balance_max" placeholder="Maximum" wire:model.defer="filter_balance_max" value=0>
                    @error('filter_balance_max')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check form-switch ms-5">
                        <input class="form-check-input" wire:model.defer="generate_report" type="checkbox"
                            id="generate_report" @error('generate_report') is-invalid @enderror>
                        <label class="form-check-label" for="generate_report">
                            Generate Report
                        </label>
                    </div>
                    @error('generate_report')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button wire:click.prevent="updateFilter()" class="btn btn-primary btn-block me-2 col">
                        Filter
                    </button>
                    <button wire:click.prevent="clearFilter()" class="btn btn-danger btn-block me-2 col">
                        Clear Filter
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>


@include('livewire.shared.search-bar-with-filter')
