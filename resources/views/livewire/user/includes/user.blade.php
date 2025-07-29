<tr class="{{ $user->hasRole('Super Admin') ? 'd-none' : '' }} {{ $user->active ? 'text-dark' : 'text-muted' }}">
    <td>
        {{ $user->name }}
        <br>
        <small class="text-muted">
            {{ $user->active ? 'Active' : 'Deactivated' }}
        </small>
    </td>
    <td>
        {{ $user->email }}
    </td>
    <td>
        {{ $user->phone }}
    </td>
    <td class="text-wrap">
        @foreach ($user->roles()->where('name', '<>', 'Super Admin')->get() as $role)
            <span class="badge bg-warning text-primary fw-bolder">
                {{ $role->name }}
                &nbsp;
            </span>
        @endforeach
    </td>
    <td>

        <div class="btn-group btn-xs" role="group" aria-label="Button group with nested dropdown">

            @if (auth()->user()->hasRole('Super Admin'))
                <a href="{{ route('users.profile', ['user' => $user]) }}" class="btn btn-info btn-xs" title="View User">
                    <i class="mdi mdi-eye"></i>
                </a>
            @endif

            @if (auth()->user()->can('users.logs'))
                <a href="{{ route('audit.user.print', ['user' => $user]) }}" class="btn btn-dark btn-xs d-nones"
                    title="View user's activity logs">
                    <i class="mdi mdi-account-search"></i>
                </a>
            @endif

            <button wire:click="editUser({{ $user->id }})" class="btn btn-primary btn-xs" title="Edit user">
                <i class="mdi mdi-tooltip-edit"></i>
            </button>

            <div class="btn-group" role="group">
                <button id="deleteDropDownButton{{ $user->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $user->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteUser({{ $user->id }})"
                            class="btn btn-danger btn-xs">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>

        </div>

    </td>
</tr>
