<tr>
    <td class="text-wrap">
        {{ $party->title }}
    </td>
    <td class="text-wrap">
        {{ $party->description }}
    </td>
    <td class="text-wrap">
        {{ $party->candidates->count() }}
    </td>
    <td class="text-wrap">
        {{ $party->created_at->diffForHumans() }}
    </td>
    <td>

        @if (auth()->user()->canany(['political.party.store']))
            <div class="btn-group btn-xs col" role="group">
                <button id="actionDropDownButton{{ $party->id }}" type="button"
                    class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-tooltip-edit"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $party->id }}">
                    <li>
                        <button class="dropdown-item" wire:click="editParty({{ $party->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    </li>
                </ul>
            </div>
        @endif

        @if (auth()->user()->can('political.party.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $party->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $party->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteParty({{ $party->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif

    </td>
</tr>
