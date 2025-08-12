<div>
    <div class="col-md-12">
        @if ($addCandidate || $updateCandidate)
            @include('livewire.candidates.includes.create-modal')
        @endif
    </div>

    @include('livewire.candidates.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addCandidate && auth()->user()->can('candidate.store'))
                    <button wire:click="addCandidate()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Candidate
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Candidates
                </h4>
                <p class="card-description"></p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Political Party</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($candidates->count())
                            @foreach ($candidates as $candidate)
                                @include('livewire.candidates.includes.item-row', $candidate)
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
                        {{ $candidates->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
