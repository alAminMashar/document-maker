<!-- Modal -->
<div class="modal fade show" id="addPermissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addPermissionModalLabel" aria-hidden="false" style="display:block;">
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPermissionModalLabel"></h5>
                <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Attach Candidate's Photo</h4>
                            <form action="{{ route('candidate.photo.store') }}" method="post"
                                enctype="multipart/form-data" class="forms-sample">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label for="document">
                                            Attach Document
                                            <span class="text-danger fw-bold">*</span>
                                        </label>
                                        <input type="file" name="document" class="form-control"
                                            @error('document') is-invalid @enderror" accept=".jpg,.jpeg,.bmp,.png"
                                            id="document">
                                        @error('document')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <input type="text" name="documentable_id" value="{{ $candidateId }}" readonly
                                        class="d-none">
                                    <input type="text" name="documentable_type" value="App\Models\Candidate" readonly
                                        class="d-none">

                                    <div class="row">
                                        <div class="col-12" wire:loading.remove>
                                            <button type="submit" class="btn btn-gradient-primary me-2 col">
                                                Submit
                                            </button>
                                            <button wire:click.prevent="cancelDocument()" class="btn btn-danger col">
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="col-12" wire:loading.block>
                                            <span class="text-warning">
                                                <i class="mdi mdi-loading mdi-spin"></i>
                                                Loading, please wait...
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Understood
                </button>
            </div>
        </div>
    </div>
</div>
