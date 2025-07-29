<div class="row">
    <div class="col-md-12">
        @if ($addArticle || $updateArticle)
            @include('livewire.help-guide.includes.create-modal')
        @endif
    </div>
    <div class="col-12 grid-margins">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    @if (auth()->user()->can('help-guide.store'))
                        <button class="btn btn-sm btn-primary" wire:click="editArticle({{ $article->id }})">
                            <i class="mdi mdi-check-decagram"></i>
                            Edit
                        </button>
                    @endif
                </div>
                <small class="fw-light text-muted">
                    {{ ucfirst($article->subTopic->topic['title'] . ' > ' . $article->subTopic['title']) }}
                </small>
                <p class="fw-light fs-3 text-info">
                    {{ ucfirst($article->title) }}
                </p>
                {!! $article->body !!}
            </div>
            <div class="card-footer">
                @foreach ($article->permissions()->get() as $permission)
                    <span class="badge badge-xs badge-info">
                        {{ ucfirst(str_replace('.', ' ', $permission->name)) }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
