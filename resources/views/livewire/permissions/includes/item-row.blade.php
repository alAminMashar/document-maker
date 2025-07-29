<tr>
    <td>
        {{ $permission->name }}
    </td>
    <td>
        {{ $permission->created_at }}
    </td>
    <td>

        <div class="btn-group btn-xs col" role="group">
            <button id="actionDropDownButton{{ $permission->id }}" type="button"
                class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-tooltip-edit"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $permission->id }}">
                <li>
                    <button class="dropdown-item" wire:click="editPermission({{ $permission->id }})">
                        <i class="mdi mdi-check-decagram"></i>
                        Edit
                    </button>
                </li>
            </ul>
        </div>

        <div class="btn-group btn-xs col" role="group">
            <button id="deleteDropDownButton{{ $permission->id }}" type="button"
                class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-delete"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $permission->id }}">
                <li>
                    <span class="dropdown-item-text">
                        Are you sure?
                    </span>
                </li>
                <li>
                    <button class="dropdown-item" wire:click="deletePermission({{ $permission->id }})">
                        <i class="mdi mdi-delete"></i>
                        Delete
                    </button>
                </li>
            </ul>
        </div>

    </td>
</tr>
