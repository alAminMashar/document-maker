<div>

    @include('livewire.activity-logs.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Audit Trails
                </h4>
                <p class="card-description">
                    Monitor all system actions on this page.
                </p>
                @if (auth()->user()->can('audit.general.print'))
                    <div class="row d-none">
                        <div class="col">
                            <a class="btn btn-sm btn-primary" href="{{ route('audit.general.print') }}">
                                <span class="mdi mdi-printer"></span>
                                Print Audit Log
                            </a>
                        </div>
                    </div>
                @endif
                <br> <br>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity</th>
                            <th>Details</th>
                            <th>Happened On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($logs)
                            @foreach ($logs as $log)
                                @include('livewire.activity-logs.includes.item-row', $log)
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
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
