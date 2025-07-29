<tr>
    <td>
        {{ $role->name }}
    </td>
    <td>
        {{ $role->guard_name }}
    </td>
    <td>
        {{ $role->permissions()->count() }}
    </td>
    <td>
        {{ $role->created_at }}
    </td>
    <td>

        <div class="btn-group btn-xs col" role="group">
            <button id="actionDropDownButton{{ $role->id }}" type="button"
                class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-tooltip-edit"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $role->id }}">
                <li>
                    <button class="dropdown-item" wire:click="editRole({{ $role->id }})">
                        <i class="mdi mdi-check-decagram"></i>
                        Edit
                    </button>
                </li>
                <li>
                    <a href="{{ route('role.show', ['role' => $role]) }}" class="dropdown-item">
                        <i class="mdi mdi-check-decagram"></i>
                        View
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-group btn-xs col" role="group">
            <button id="deleteDropDownButton{{ $role->id }}" type="button"
                class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-delete"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $role->id }}">
                <li>
                    <span class="dropdown-item-text">
                        Are you sure?
                    </span>
                </li>
                <li>
                    <button class="dropdown-item" wire:click="deleteRole({{ $role->id }})">
                        <i class="mdi mdi-delete"></i>
                        Delete
                    </button>
                </li>
            </ul>
        </div>

    </td>
</tr>
