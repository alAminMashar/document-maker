<div>
    <div class="col-md-12">
        @if ($addTopic || $updateTopic)
            @include('livewire.topic.includes.create-modal')
        @endif
    </div>

    @include('livewire.topic.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                @if (!$addTopic && auth()->user()->can('topic.store'))
                    <button wire:click="addTopic()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Add Topic
                    </button>
                @endif

                <h4 class="card-title text-primary">
                    Topics
                </h4>
                <p class="card-description"></p>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Articles</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($topics->count())
                            @foreach ($topics as $topic)
                                @include('livewire.topic.includes.item-row', $topic)
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
                        {{ $topics->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
