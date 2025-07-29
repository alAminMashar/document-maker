<div>
    <div class="col-md-10 mb-2">
        @if ($addPermission || $updatePermission)
            @include('livewire.permissions.includes.create-modal')
        @endif
    </div>

    @include('livewire.permissions.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (!$addPermission)
                    <button wire:click="addPermission()" class="btn btn-info btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#addPermissionModal">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Permission
                    </button>
                @endif
                <h4 class="card-title">
                    Permissions
                </h4>
                <p class="card-description">
                    All system registered permissions.
                </p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions)
                            @foreach ($permissions as $permission)
                                @include('livewire.permissions.includes.item-row', $permission)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br><br>
                <div class="row">
                    <div class="col">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
