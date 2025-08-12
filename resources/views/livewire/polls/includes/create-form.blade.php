<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addPoll)
                <h4 class="card-title">Add Poll</h4>
            @endif
            @if ($updatePoll)
                <h4 class="card-title">Update Poll Details</h4>
            @endif
            <form class="forms-sample">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="title">
                            Title
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Enter title" wire:model.defer="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="description">
                            Description
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" placeholder="Enter description" wire:model.defer="description">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="starting_at">
                            Starting At
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="datetime-local" class="form-control @error('starting_at') is-invalid @enderror"
                            id="starting_at" placeholder="Enter starting at" wire:model.defer="starting_at">
                        @error('starting_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="ending_at">
                            Ending At
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="datetime-local" class="form-control @error('ending_at') is-invalid @enderror"
                            id="ending_at" placeholder="Enter ending at" wire:model.defer="ending_at">
                        @error('ending_at')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addPoll)
                            <button wire:click.prevent="storePoll()" class="btn btn-gradient-primary me-2 col">
                                Submit
                            </button>
                        @endif
                        @if ($updatePoll)
                            <button wire:click.prevent="updatePoll()" class="btn btn-gradient-primary me-2 col">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelPoll()" class="btn btn-danger col">
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

                {{--
                    <div class="col-12" wire:loading.block wire:loading.remove>
                        <span class="text-warning">
                            <i class="mdi mdi-loading mdi-spin"></i>
                            Loading, please wait...
                        </span>
                    </div>
                --}}

            </form>
        </div>
    </div>
</div>
