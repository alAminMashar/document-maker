<div>
    <div class="col-md-10 mb-2">
        @if ($addDocument)
            @include('livewire.document-custody.includes.create-modal')
        @endif
    </div>

    @include('livewire.document-custody.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (!$addDocument)
                    <button wire:click="addDocument()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Document
                    </button>
                @endif
                <h4 class="card-title">
                    Document Custody
                </h4>
                <p class="card-description">
                    Records of all documents held for respective documents.
                </p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Document Type</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($documents)
                            @foreach ($documents as $document)
                                @include('livewire.document-custody.includes.item-row', $document)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="col">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
