<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Document</h4>
            <form action="{{ route('documents-custody.store') }}" method="post" enctype="multipart/form-data"
                class="forms-sample">
                @csrf
                <div class="row">

                    <div class="form-group col-6">
                        <label for="datalist" class="form-label">
                            Select Employee
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input name="documentable_id"
                            class="form-control form-control-sm @error('documentable_id') is-invalid @enderror"
                            list="employees_list" id="datalist" placeholder="search employee...">
                        <datalist id="employees_list">
                            @if ($employees->count())
                                @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">
                                        {{ $emp->describe() }}
                                        {{ $emp->engaged() ? '( Engaged )' : '( Un Deployed )' }}
                                    </option>
                                @endforeach
                            @else
                                <option>No employees available</option>
                            @endif
                        </datalist>
                        @error('documentable_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="document_types">
                            Document Type
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <select name="document_type_id"
                            class="form-control form-control-sm @error('document_type_id') is-invalid @enderror"
                            id="document_types">
                            <option>Select Option</option>
                            @foreach ($document_types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('document_type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="document">
                            Attach Document
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="file" name="document" class="form-control"
                            @error('document') is-invalid @enderror"
                            accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
                            id="document">
                        @error('document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <div class="form-check form-switch pt-3 ps-5">
                            <input class="form-check-input" type="checkbox" id="originalCheck" name="original_received">
                            <label class="form-check-label" for="originalCheck">
                                Original Received
                            </label>
                        </div>
                    </div>

                    <input type="text" name="documentable_type" value="App\Models\Employee" readonly class="d-none">

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
