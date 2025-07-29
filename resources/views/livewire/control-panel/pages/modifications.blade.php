<div>

    @include('livewire.control-panel.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4 class="card-title brand-primary">
                            Control Panel
                        </h4>
                        <p class="card-description">
                            Showing System Change Requests. Please use the <b>filter</b> or <b>search</b> function to
                            find specific types.
                            @if ($filter)
                                <br>
                                <small class="text-info">
                                    <b
                                        class="badge badge-xs badge-primary">{{ number_format($result_count) . ' results' }}</b>&nbsp;
                                    {{ $filter_description }}
                                </small>
                            @endif
                        </p>
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
                        @if ($modifications)
                            @foreach ($modifications as $modification)
                                @include('livewire.control-panel.includes.item-row', $modification)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" align="center">
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
            </div>
        </div>
    </div>

</div>
