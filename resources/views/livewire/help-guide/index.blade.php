<div>
    <div class="col-md-12">
        @if ($addArticle || $updateArticle)
            @include('livewire.help-guide.includes.create-modal')
        @endif
    </div>

    @include('livewire.help-guide.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addArticle && auth()->user()->can('help-guide.store'))
                    <button wire:click="addArticle()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Article
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Help Guide Articles
                </h4>
                <p class="card-description">
                    This articles serve as a guide for users learning to use the role related modules. These include
                    guides on how to troubleshoot to find solutions to scenarios you may encounter.
                </p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Sub Topic</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($articles->count())
                            @foreach ($articles as $article)
                                @include('livewire.help-guide.includes.item-row', $article)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <br>
                <div class="row">
                    <div class="col">
                        {{ $articles->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

</div>
