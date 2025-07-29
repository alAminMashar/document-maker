<div>
    <div class="col-md-10 mb-2">
        @if ($addRole || $updateRole)
            @include('livewire.roles.includes.create-modal')
        @endif
    </div>

    @include('livewire.roles.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (!$addRole)
                    <button wire:click="addRole()" class="btn btn-info btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#addRoleModal">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Roles
                    </button>
                @endif
                <h4 class="card-title">
                    Roles
                </h4>
                <p class="card-description">
                    All system registered roles.
                </p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Guards</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles)
                            @foreach ($roles as $role)
                                @include('livewire.roles.includes.item-row', $role)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br><br>
                <div class="row">
                    <div class="col">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
