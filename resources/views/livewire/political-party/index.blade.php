<div>
    <div class="col-md-12">
        @if ($addParty || $updateParty)
            @include('livewire.political-party.includes.create-modal')
        @endif
    </div>

    @include('livewire.political-party.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addParty && auth()->user()->can('political.party.store'))
                    <button wire:click="addParty()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Political Party
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Political Party
                </h4>
                <p class="card-description"></p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Candidates</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($parties->count())
                            @foreach ($parties as $party)
                                @include('livewire.political-party.includes.item-row', $party)
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
                        {{ $parties->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
