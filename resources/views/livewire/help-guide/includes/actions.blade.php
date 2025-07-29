@if (auth()->user()->canany(['help-guide.store', 'help-guide.show', 'help-guide.delete']))
    <div class="float-end">
        @if (auth()->user()->canany(['help-guide.store', 'help-guide.show']))
            <div class="btn-group btn-xs col" role="group">
                @if (auth()->user()->can('help-guide.show'))
                    <button class="btn btn-sm btn-info" wire:click="showArticle({{ $article->id }})">
                        <i class="mdi mdi-eye"></i>
                        View
                    </button>
                @endif
                @if (auth()->user()->can('help-guide.store'))
                    <button class="btn btn-sm btn-primary" wire:click="editArticle({{ $article->id }})">
                        <i class="mdi mdi-check-decagram"></i>
                        Edit
                    </button>
                @endif

            </div>
        @endif

        @if (auth()->user()->can('help-guide.delete'))
            <div class="btn-group btn-xs col" role="group">
                <button id="deleteDropDownButton{{ $article->id }}" type="button"
                    class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-delete"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $article->id }}">
                    <li>
                        <span class="dropdown-item-text">
                            Are you sure?
                        </span>
                    </li>
                    <li>
                        <button class="dropdown-item" wire:click="deleteArticle({{ $article->id }})">
                            <i class="mdi mdi-delete"></i>
                            Delete
                        </button>
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endif
