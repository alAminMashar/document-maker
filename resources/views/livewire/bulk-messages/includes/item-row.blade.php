<tr>
    <td class="text-wrap">
        {{ $customer->name }}
    </td>
    <td class="text-wrap">
        {{ $customer->email }}
    </td>
    <td class="text-wrap">
        {{ $customer->phone }}
    </td>
    <td class="text-wrap">
        N/A
    </td>
    <td class="text-wrap">
        {{ $customer->created_at }}
    </td>
    <td>

        <div class="btn-group btn-xs col" role="group">
            <button id="actionDropDownButton{{ $customer->id }}" type="button"
                class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-tooltip-edit"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $customer->id }}">
                <li>
                    <button class="dropdown-item" wire:click="editCustomer({{ $customer->id }})">
                        <i class="mdi mdi-check-decagram"></i>
                        Edit
                    </button>
                </li>
                <li>
                    <a href="{{ route('employee.show', ['employee' => $customer]) }}" class="dropdown-item">
                        <i class="mdi mdi-check-decagram"></i>
                        View
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-group btn-xs col" role="group">
            <button id="deleteDropDownButton{{ $customer->id }}" type="button"
                class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-delete"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $customer->id }}">
                <li>
                    <span class="dropdown-item-text">
                        Are you sure?
                    </span>
                </li>
                <li>
                    <button class="dropdown-item" wire:click="deleteCustomer({{ $customer->id }})">
                        <i class="mdi mdi-delete"></i>
                        Delete
                    </button>
                </li>
            </ul>
        </div>

    </td>
</tr>
