<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addDocType)
                <h4 class="card-title">Add Document Type</h4>
            @endif
            @if ($updateDocType)
                <h4 class="card-title">Update Document Type Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group col-6">
                        <label for="name">
                            Name
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter name" wire:model.defer="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="description">
                            Description
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" placeholder="Describe the Document Type" wire:model.defer="description">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12" wire:loading.remove>
                            @if ($addDocType)
                                <button wire:click.prevent="storeDocType()" class="btn btn-gradient-primary me-2 col">
                                    Submit
                                </button>
                            @endif
                            @if ($updateDocType)
                                <button wire:click.prevent="updateDocType()" class="btn btn-gradient-primary me-2 col">
                                    Save Changes
                                </button>
                            @endif
                            <button wire:click.prevent="cancelDocType()" class="btn btn-danger col">
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

                </div>
            </form>
        </div>
    </div>
</div>
