<div>
    <div class="col-md-12">
        @if ($addPoll || $updatePoll)
            @include('livewire.polls.includes.create-modal')
        @endif
    </div>

    @include('livewire.polls.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addPoll && auth()->user()->can('polls.store'))
                    <button wire:click="addPoll()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Poll
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Polls
                </h4>
                <p class="card-description"></p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Starting At</th>
                            <th>Ending At</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($polls->count())
                            @foreach ($polls as $poll)
                                @include('livewire.polls.includes.item-row', $poll)
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
                        {{ $polls->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
