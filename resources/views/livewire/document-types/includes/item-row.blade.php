<tr>
    <td>
        {{ $type->name }}
    </td>
    <td>
        {{ $type->description }}
    </td>
    <td>
        {{ $type->created_at }}
    </td>
    <td>

        <div class="btn-group btn-xs col" role="group">
            <button id="actionDropDownButton{{ $type->id }}" type="button"
                class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-tooltip-edit"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $type->id }}">
                <li>
                    <button class="dropdown-item" wire:click="editDocType({{ $type->id }})">
                        <i class="mdi mdi-check-decagram"></i>
                        Edit
                    </button>
                </li>
            </ul>
        </div>

        <div class="btn-group btn-xs col" role="group">
            <button id="deleteDropDownButton{{ $type->id }}" type="button"
                class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-delete"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $type->id }}">
                <li>
                    <span class="dropdown-item-text">
                        Are you sure?
                    </span>
                </li>
                <li>
                    <button class="dropdown-item" wire:click="deleteDocType({{ $type->id }})">
                        <i class="mdi mdi-delete"></i>
                        Delete
                    </button>
                </li>
            </ul>
        </div>

    </td>
</tr>
