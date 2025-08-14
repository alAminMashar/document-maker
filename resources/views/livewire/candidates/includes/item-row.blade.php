<tr>
    <td class="text-wrap">
        {{ $candidate->name }}
    </td>
    <td class="text-wrap">
        {{ $candidate->title }}
    </td>
    <td class="text-wrap">
        {{ $candidate->politicalParty['title'] }}
    </td>
    <td class="text-wrap">
        {{ $candidate->active ? 'Active' : 'In Active' }}
    </td>
    <td class="text-wrap">
        {{ $candidate->created_at }}
    </td>
    <td>

        @if (auth()->user()->canany(['candidates.store']))
            <div class="btn-group btn-xs col" role="group">
                <button id="actionDropDownButton{{ $candidate->id }}" type="button"
                    class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-tooltip-edit"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $candidate->id }}">
                    <li>
                        <button class="dropdown-item" wire:click="editCandidate({{ $candidate->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="addDocument({{ $candidate->id }})"
                            title="Upload Photo">
                            <i class="mdi mdi-attachment"></i>
                            Upload Photo
                            </a>
                    </li>
                </ul>
            </div>
        @endif

        @if (auth()->user()->can('candidates.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $candidate->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $candidate->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteCandidate({{ $candidate->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif

    </td>
</tr>
