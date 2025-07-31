@if (auth()->user()->canany(['letter.store', 'letter.show', 'letter.delete']))
    <div class="btn-group btn-xs">
        @if (auth()->user()->canany(['letter.store', 'letter.show']))
            <div class="btn-group btn-xs col" role="group">

                @if (auth()->user()->can('letter.store'))
                    <button class="btn btn-sm btn-primary" wire:click="editLetter({{ $letter->id }})"
                        title="Edit Letter">
                        <i class="mdi mdi-check-decagram"></i>
                    </button>
                @endif

                @if (auth()->user()->can('letter.show'))
                    <a href="{{ route('letter.download', ['letter' => $letter]) }}" class="btn btn-sm btn-info"
                        title="Download Letter">
                        <i class="mdi mdi-folder-download"></i>
                    </a>
                @endif

            </div>
        @endif

        @if (auth()->user()->can('letter.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $letter->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $letter->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteLetter({{ $letter->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endif
