<div>
    <div class="col-md-12">
        @if ($addVoter || $updateVoter)
            @include('livewire.voters.includes.create-modal')
        @endif
    </div>

    @include('livewire.voters.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addVoter && auth()->user()->can('voters.store') && auth()->user()->hasRole('Super Admin'))
                    <button wire:click="addVoter()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Voter
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Voters
                </h4>
                <p class="card-description"></p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contacts</th>
                            <th>Browser</th>
                            <th>Location</th>
                            <th>Device</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($voters->count())
                            @foreach ($voters as $voter)
                                @include('livewire.voters.includes.item-row', $voter)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <br>
                <div class="row">
                    <div class="col">
                        {{ $voters->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
