    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if ($addUser)
                    <h4 class="card-title">Add User</h4>
                @endif
                @if ($updateUser || $updateProfile)
                    <h4 class="card-title">Update User Details</h4>
                @endif
                @if ($updatePassword)
                    <h4 class="card-title">Update User Password</h4>
                @endif
                <form class="forms-sample">
                    <div class="row">

                        @if (!$updatePassword || $updateProfile)
                            <div class="form-group col-6">
                                <label for="name">
                                    Username
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter name" wire:model.defer="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="name">
                                    Phone
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" placeholder="Enter phone number" wire:model.defer="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="email">
                                    Email address
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Enter email" wire:model.defer="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if ($addUser || $updateUser)

                            <div class="form-group col-6">
                                <label for="role">
                                    Select Roles to Assign
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <select wire:model.defer="selected_roles" multiple class="form-select form-select-sm"
                                    id="role" @error('selected_roles') is-invalid @enderror>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('selected_roles')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <div class="form-check form-switch ms-5">
                                    <input class="form-check-input" wire:model.defer="active" type="checkbox"
                                        id="active" @error('active') is-invalid @enderror>
                                    <label class="form-check-label" for="active">
                                        {{ $active == 1 ? 'Active' : 'Deactivated' }}
                                    </label>
                                </div>
                                @error('active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if ($addUser || $updatePassword)
                            <div class="form-group col-6">
                                <label for="name">
                                    Password
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <input type="password" class="form-control autocomplete="password"
                                    @error('password') is-invalid @enderror" id="password" placeholder="Enter password"
                                    wire:model.lazy="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="name">
                                    Confirm Password
                                    <span class="fw-bolder text-danger">*</span>
                                </label>
                                <input type="password" class="form-control autocomplete="password_confirm"
                                    @error('password_confirm') is-invalid @enderror" id="password_confirm"
                                    placeholder="Enter password confirm" wire:model.lazy="password_confirm">
                                @error('password_confirm')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12" wire:loading.remove>
                                @if ($addUser)
                                    <button wire:click.prevent="storeUser()" class="btn btn-gradient-primary me-2 col">
                                        Submit
                                    </button>
                                @endif
                                @if ($updateUser || $updateProfile)
                                    <button wire:click.prevent="updateUser()" class="btn btn-gradient-primary me-2 col">
                                        Save Changes
                                    </button>
                                @endif
                                @if ($updatePassword)
                                    <button wire:click.prevent="touchPassword()"
                                        class="btn btn-gradient-primary me-2 col">
                                        Save Changes
                                    </button>
                                @endif
                                <button wire:click.prevent="cancelUser()" class="btn btn-danger col">
                                    Cancel
                                </button>
                            </div>
                            <div class="col-12" wire:loading.block>
                                <span wire:loading.block>
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
