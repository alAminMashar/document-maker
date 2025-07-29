<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="card-title">
                        Permissions
                    </h4>
                    <p class="card-description">
                        All {{ $role->permissions()->count() }} permissions attached to {{ $role->name }}
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
                            @if ($rolePermissions)
                                @foreach ($rolePermissions as $permission)
                                    @include('livewire.roles.includes.permission-row', $permission)
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" align="center">
                                        No Records Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <br><br>
                    <div class="col">
                        {{ $rolePermissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
