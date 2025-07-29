<tr>
    <td class="text-wrap">
        {{ $topic->title }}
    </td>
    <td class="text-wrap">
        {{ $topic->description }}
    </td>
    <td class="text-wrap">
        {{-- {{ $topic->articles->count() }} --}}
    </td>
    <td class="text-wrap">
        {{ $topic->created_at }}
    </td>
    <td>

        @if (auth()->user()->canany(['topic.store']))
            <div class="btn-group btn-xs col" role="group">
                <button id="actionDropDownButton{{ $topic->id }}" type="button"
                    class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-tooltip-edit"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="actionDropDownButton{{ $topic->id }}">
                    <li>
                        <button class="dropdown-item" wire:click="editTopic({{ $topic->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    </li>
                </ul>
            </div>
        @endif

        @if (auth()->user()->can('topic.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $topic->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $topic->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteTopic({{ $topic->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif

    </td>
</tr>
