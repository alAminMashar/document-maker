<div class="row">
    @if ($updatePassword || $updateProfile)
        @include('livewire.user.includes.create-modal')
    @endif
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @if (!$updateProfile)
                    <button class="btn btn-primary btn-sm" type="button" wire:click="editUser()">
                        Update
                    </button>
                @endif
                @if (!$updatePassword)
                    <button class="btn btn-success btn-sm" type="button" wire:click="updatePassword()">
                        Change Password
                    </button>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fw-bold"> Title </th>
                                <th class="fw-bold"> Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Name
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Email
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Phone
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Department
                                </td>
                                <td>
                                    {{ $user->department['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mdi mdi-envelope"></span>
                                    Role
                                </td>
                                <td>
                                    @foreach (Auth::user()->roles()->where('name', '<>', 'Super Admin')->orderBy('created_at', 'ASC')->take(1)->get() as $role)
                                        <span class="text-primary text-small">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
