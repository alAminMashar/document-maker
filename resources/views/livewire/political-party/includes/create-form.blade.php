<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addParty)
                <h4 class="card-title">Add Political Party</h4>
            @endif
            @if ($updateParty)
                <h4 class="card-title">Update Political Party Details</h4>
            @endif
            <form class="forms-sample">

                <div class="row">

                    <div class="form-group col-6">
                        <label for="title">
                            Title
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Enter title" wire:model="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="description">
                            Description
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" placeholder="Enter description" wire:model="description">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addParty)
                            <button wire:click.prevent="storeParty()" class="btn btn-gradient-primary me-2 col">
                                Submit
                            </button>
                        @endif
                        @if ($updateParty)
                            <button wire:click.prevent="updateParty()" class="btn btn-gradient-primary me-2 col">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelParty()" class="btn btn-danger col">
                            Cancel
                        </button>
                    </div>
                    <div class="col-12" wire:loading.block>
                        <span class="text-warning">
                            <i class="mdi mdi-loading mdi-spin"></i>
                            Loading, please wait...
                        </span>
                    </div>
                </div>

                {{--
                    <div class="col-12" wire:loading.block wire:loading.remove>
                        <span class="text-warning">
                            <i class="mdi mdi-loading mdi-spin"></i>
                            Loading, please wait...
                        </span>
                    </div>
                --}}

            </form>
        </div>
    </div>
</div>
