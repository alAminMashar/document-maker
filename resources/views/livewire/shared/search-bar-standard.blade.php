<div class="row grid-margin">
    <div class="col-12">
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
</div>
