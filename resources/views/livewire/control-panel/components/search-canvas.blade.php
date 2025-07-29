<div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffCanvas" aria-labelledby="searchOffCanvasLabel"
    wire:loading.remove>
    <div class="offcanvas-header">
        <h5 id="searchOffCanvasLabel">Filter Employees</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form class="forms-sample row">

                <div class="form-group">
                    <label for="filter_type">By Request Type</label>
                    <select wire:model.defer="filter_type" class="form-control form-control-sm" id="filter_type"
                        @error('filter_type') is-invalid @enderror>
                        <option value="">Select Option</option>
                        @foreach ($type_names as $item)
                            <option value="{{$item}}">
                                {{$item}}
                            </option>
                        @endforeach
                    </select>

                    @error('filter_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <p>
                        <i class="text-info">
                            Filter by Start Date Range
                        </i>
                    </p>
                </div>

                <div class="form-group col-6">
                    <label for="filter_created_from">
                        From
                        <span class="text-danger fw-bold">*</span>
                    </label>
                    <input type="date"
                        class="form-control form-control-sm @error('filter_created_from') is-invalid @enderror"
                        id="filter_created_from" placeholder="Start Date" wire:model.defer="filter_created_from"
                        value="">
                    @error('filter_created_from')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label for="filter_created_to">
                        To
                        <span class="text-danger fw-bold">*</span>
                    </label>
                    <input type="date"
                        class="form-control form-control-sm @error('filter_created_to') is-invalid @enderror"
                        id="filter_created_to" placeholder="Start Date" wire:model.defer="filter_created_to" value="">
                    @error('filter_created_to')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check form-switch ms-5">
                        <input class="form-check-input" wire:model.defer="active" type="checkbox" id="active"
                            @error('active') is-invalid @enderror>
                        <label class="form-check-label" for="active">
                            Show {{$active?'Pending':'Past'}} Changes
                        </label>
                    </div>
                    @error('active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check form-switch ms-5">
                        <input class="form-check-input" wire:model.defer="generate_report" type="checkbox" id="generate_report"
                            @error('generate_report') is-invalid @enderror>
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
