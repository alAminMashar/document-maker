<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if ($addCandidate)
                <h4 class="card-title">Add Candidate</h4>
            @endif
            @if ($updateCandidate)
                <h4 class="card-title">Update Candidate Details</h4>
            @endif
            <form class="forms-sample">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">
                            Name
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter name" wire:model.defer="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="datalist" class="form-label">
                            Select Party
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input wire:model.defer="political_party_id"
                            class="form-control form-control-sm @error('political_party_id') is-invalid @enderror"
                            list="candidates_list" id="datalist" placeholder="search employee...">
                        <datalist id="candidates_list">
                            @if ($parties->count())
                                @foreach ($parties as $party)
                                    <option value="{{ $party->id }}">
                                        {{ $party->title }}
                                    </option>
                                @endforeach
                            @else
                                <option>No parties available</option>
                            @endif
                        </datalist>
                        @error('political_party_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (auth()->user()->hasRole('Super Admin'))
                        <div class="form-group col-6">
                            <label for="multiplier">
                                Vote Multiplier
                                <span class="text-danger fw-bold">*</span>
                            </label>
                            <input type="text" class="form-control @error('multiplier') is-invalid @enderror"
                                id="multiplier" placeholder="Enter multiplier" wire:model.defer="multiplier">
                            @error('multiplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <div class="form-check form-switch ms-5">
                            <input class="form-check-input" wire:model.defer.defer="active" type="checkbox"
                                id="active" @error('active') is-invalid @enderror>
                            <label class="form-check-label" for="active">
                                This Candidate is Active<br>
                                <small class="text-muted">
                                    Leave off to ommit from ballots and polls
                                </small>
                            </label>
                        </div>
                        @error('active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" wire:loading.remove>
                        @if ($addCandidate)
                            <button wire:click.prevent="storeCandidate()" class="btn btn-gradient-primary me-2 col">
                                Submit
                            </button>
                        @endif
                        @if ($updateCandidate)
                            <button wire:click.prevent="updateCandidate()" class="btn btn-gradient-primary me-2 col">
                                Save Changes
                            </button>
                        @endif
                        <button wire:click.prevent="cancelCandidate()" class="btn btn-danger col">
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
