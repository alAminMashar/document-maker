<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Exported Files
                </h4>
                <p class="text-muted fs-6">
                    Change Reports Generated will appear here.
                </p>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Document Type</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($documents)
                                @foreach ($documents as $document)
                                    @include('livewire.pay-roll.includes.document-row', $document)
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
                </div>
            </div>
        </div>
    </div>

</div>
