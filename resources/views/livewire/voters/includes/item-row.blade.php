<tr>
    <td class="text-wrap">
        {{ $voter->name }}
    </td>
    <td class="text-wrap">
        {{ $voter->phone_number }} <br>
        <small class="text-muted">
            {{ $voter->email }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $voter->browser }}<br>
        <small class="text-muted">
            {{ $voter->ip_address }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $voter->country }}<br>
        <small class="text-muted">
            {{ $voter->city }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $voter->device }}<br>
        <small class="text-muted">
            {{ $voter->platform }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $voter->referer }}
    </td>
    <td>

        @if (auth()->user()->canany(['voter.store']))
            <div class="btn-group btn-xs col" role="group">
                <button id="actionDropDownButton{{ $voter->id }}" type="button"
                    class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-tooltip-edit"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $voter->id }}">
                    <li>
                        <button class="dropdown-item" wire:click="editVoter({{ $voter->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    </li>
                </ul>
            </div>
        @endif

        @if (auth()->user()->can('voter.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $voter->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $voter->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteVoter({{ $voter->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif

    </td>
</tr>
