<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Add Users from Excel File
            </h4>
            <form action="{{ route('import.users') }}" method="post" enctype="multipart/form-data" class="forms-sample">
                @csrf
                <div class="row">

                    <div class="form-group col-12">
                        <label for="document">
                            Select Document
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="file" name="document" required class="form-control"
                            @error('document') is-invalid @enderror" accept=".csv,.rtf,.xlsx,.xls" id="document">
                        @error('document')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-gradient-primary me-2 col">
                                Submit
                            </button>
                            <button wire:click.prevent="cancelUser()" class="btn btn-danger col">
                                Cancel
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
