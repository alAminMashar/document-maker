<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4 class="card-title">
                            Control Panel
                        </h4>
                        <p class="card-description">
                            Showing all {{ $current_type }} pending change requests
                        </p>
                        @include('livewire.control-panel.includes.filter')
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Change Request</th>
                            <th>Requested By</th>
                            <th>Approvals</th>
                            <th>Disapprovals</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($modifications->count())
                            @foreach ($modifications as $modification)
                                @include('livewire.control-panel.includes.item-row', $modification)
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
                        {{ $modifications->links() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small class="text-muted">
                            Showing
                            <span class="text-bold">
                                {{ $modifications->count() }}
                            </span>
                            records of
                            <span class="text-bold">
                                {{ $modifications->total() }}
                            </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
