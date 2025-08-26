<div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffCanvas" aria-labelledby="searchOffCanvasLabel">
    <div class="offcanvas-header">
        <h5 id="searchOffCanvasLabel">Generate Voters' Poll Report</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form class="forms-sample row">

                <div class="form-group">
                    <label for="filter_poll_id">By Poll</label>
                    <select wire:model.defer="filter_poll_id" class="form-control form-control-sm" id="filter_poll_id"
                        @error('filter_poll_id') is-invalid @enderror>
                        <option>Select Poll</option>
                        @foreach ($polls as $poll)
                            <option value="{{ $poll->id }}">
                                {{ $poll->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('filter_poll_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <p>
                        <b class="text-info">
                            Filter by Date Range
                        </b>
                    </p>
                </div>

                <div class="form-group col-6">
                    <label for="filter_start_date">
                        Start Date
                        <span class="text-danger fw-bold">*</span>
                    </label>
                    <input type="date"
                        class="form-control form-control-sm @error('filter_start_date') is-invalid @enderror"
                        id="filter_start_date" placeholder="Start Date" wire:model.defer="filter_start_date"
                        value="">
                    @error('filter_start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label for="filter_end_date">
                        End Date
                        <span class="text-danger fw-bold">*</span>
                    </label>
                    <input type="date"
                        class="form-control form-control-sm @error('filter_end_date') is-invalid @enderror"
                        id="filter_end_date" placeholder="End Date" wire:model.defer="filter_end_date" value="">
                    @error('filter_end_date')
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
