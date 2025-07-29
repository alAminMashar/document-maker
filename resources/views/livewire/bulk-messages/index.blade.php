<div>
    <div class="col-md-12">
        @if ($addRecord || $updateRecord || $readRecord)
            @include('livewire.inventory-records.includes.create-modal')
        @endif
    </div>

    @include('livewire.inventory-records.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (!$addRecord && auth()->user()->can('inventory-records.store'))
                    <button wire:click="addRecord()" class="btn btn-info btn-sm float-end">
                        <i class="mdi mdi-playlist-plus"></i>
                        Record Feedback
                    </button>
                @endif
                <h4 class="card-title text-primary">
                    Customer Feedback
                </h4>
                <p class="card-description"></p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Customer Information</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Recorded On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($feedbacks->count())
                            @foreach ($feedbacks as $feedback)
                                @include('livewire.inventory-records.includes.item-row', $feedback)
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
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
