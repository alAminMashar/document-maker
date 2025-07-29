<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addPermission)
                <h4 class="card-title">Add Permission</h4>
            @endif
            @if ($updatePermission)
                <h4 class="card-title">Update Permission Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group col-12">
                        <label for="name">
                            Name
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter name" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12" wire:loading.remove>
                            @if ($addPermission)
                                <button wire:click.prevent="storePermission()"
                                    class="btn btn-gradient-primary me-2 col">
                                    Submit
                                </button>
                            @endif
                            @if ($updatePermission)
                                <button wire:click.prevent="updatePermission()"
                                    class="btn btn-gradient-primary me-2 col">
                                    Save Changes
                                </button>
                            @endif
                            <button wire:click.prevent="cancelPermission()" class="btn btn-danger col">
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
