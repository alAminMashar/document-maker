<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addRole)
                <h4 class="card-title">Add Role</h4>
            @endif
            @if ($updateRole)
                <h4 class="card-title">Update Role Details</h4>
            @endif
            <form class="forms-sample">
                <div class="row">

                    <div class="form-group">
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

                    <div class="form-group">
                        <span class="fw-thin fs-5">
                            Select permissions to assign to roles
                        </span>
                        <div class="row p-5">
                            @if ($permissions->count())
                                @foreach ($permissions as $perm)
                                    <div class="form-check form-switch col-3">
                                        <input wire:model.defer="selected_permission.{{ $perm->id }}"
                                            class="form-check-input" type="checkbox" id="{{ $perm->id }}-permSwitch"
                                            value="{{ $perm->name }}">
                                        <label class="form-check-label fw-6" for="{{ $perm->id }}-permSwitch">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning" role="alert">
                                    No permissions available
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12" wire:loading.remove>
                            @if ($addRole)
                                <button wire:click.prevent="storeRole()" class="btn btn-gradient-primary me-2 col">
                                    Submit
                                </button>
                            @endif
                            @if ($updateRole)
                                <button wire:click.prevent="updateRole()" class="btn btn-gradient-primary me-2 col">
                                    Save Changes
                                </button>
                            @endif
                            <button wire:click.prevent="cancelRole()" class="btn btn-danger col">
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
