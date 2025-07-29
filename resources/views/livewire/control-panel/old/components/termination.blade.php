<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-description">
                    Showing pending dismissal requests
                </p>
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
                        @if ($active_termination->count())
                            @foreach ($active_termination as $modification)
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
            </div>
        </div>
    </div>
</div>
