<div class="row grid-margin">
    <div class="col-10">
        <div class="search-field d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <input type="text" class="form-control border-0" wire:model.lazy="search"
                        placeholder="Search by keywords or parts of the item you are looking for...">
                    <button class="input-group-prepend" wire:click.prevent="">
                        <i class="input-group-text bg-gradient-info text-white mdi mdi-magnify">
                            Search
                        </i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-2">
        <button class="btn btn-secondary btn-block col {{ $filter ? 'd-none' : '' }}" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#searchOffCanvas" aria-controls="searchOffCanvas">
            <span class="mdi mdi-filter-outline"></span>
            Filter
        </button>
        <button wire:click.prevent="clearFilter()"
            class="btn btn-danger btn-block me-2 col {{ $filter ? '' : 'd-none' }}">
            <span class="mdi mdi-filter-remove-outline"></span>
            Clear
        </button>
    </div>
</div>
