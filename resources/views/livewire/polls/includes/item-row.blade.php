<tr>
    <td class="text-wrap">
        {{ $poll->title }} <br>
        <small class="text-muted">
            {{ $poll->description }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $poll->starting_at }}
    </td>
    <td class="text-wrap">
        {{ $poll->ending_at }}
    </td>
    <td class="text-wrap">
        {{ $poll->created_at }}
    </td>
    <td class="text-wrap">
        {{ $poll->user['name'] }}
    </td>
    <td>

        @if (auth()->user()->canany(['poll.store']))
            <div class="btn-group btn-xs col" role="group">
                <button id="actionDropDownButton{{ $poll->id }}" type="button"
                    class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-tooltip-edit"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $poll->id }}">
                    <li>
                        <button class="dropdown-item" wire:click="editPoll({{ $poll->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    </li>
                </ul>
            </div>
        @endif

        @if (auth()->user()->can('poll.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $poll->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $poll->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deletePoll({{ $poll->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif

    </td>
</tr>
