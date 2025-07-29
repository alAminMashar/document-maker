<div>
    <div class="col-md-10 mb-2">
        @if ($addDocType || $updateDocType)
            @include('livewire.document-types.includes.create-modal')
        @endif
    </div>

    @include('livewire.document-types.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (!$addDocType)
                    <button wire:click="addDocType()" class="btn btn-info btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#addDocTypeModal">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Document Type
                    </button>
                @endif
                <h4 class="card-title">
                    Document Types
                </h4>
                <p class="card-description">
                    All system registered document types.
                </p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($doc_types)
                            @foreach ($doc_types as $type)
                                @include('livewire.document-types.includes.item-row', $type)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="col">
                        {{ $doc_types->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
