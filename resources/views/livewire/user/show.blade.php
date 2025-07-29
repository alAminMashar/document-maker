<div>
    <div class="col-md-12">
        @if ($addUser || $updateUser || $importUsers)
            @include('livewire.user.includes.create-modal')
        @endif
    </div>

    @include('livewire.user.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Users
                </h4>
                <p class="card-description">
                    All system registered users.
                </p>
                @if (!$addUser)
                    <button wire:click="addUser()" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                        data-bs-target="#addUserModal">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add User
                    </button>
                @endif
                @if (!$importUsers && auth()->user()->can('users.import'))
                    <button wire:click="importUsers()" class="btn btn-success btn-sm float-right" data-bs-toggle="modal"
                        data-bs-target="#addUserModal">
                        <i class="mdi mdi-file-excel"></i>
                        Import
                    </button>
                @endif
                <a href="{{ route('export.users') }}" class="btn btn-info btn-sm float-right">
                    <i class="mdi mdi-file-excel-box"></i>
                    Export
                </a>
                <br>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users)
                            @foreach ($users as $user)
                                @include('livewire.user.includes.user', $user)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br><br>
                <div class="row">
                    <div class="col">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
