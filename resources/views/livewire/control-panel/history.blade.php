<div>
    <div class="row">
        <div class="col-12 grid-margin">
            @include('livewire.control-panel.components.search-canvas')
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="card-title">
                                Control Panel History
                            </h4>
                            <p class="card-description">
                                Showing all {{ $current_type }} past change requests
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($modifications->count())
                                @foreach ($modifications as $modification)
                                    <tr>
                                        <td class="text-wrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-wrap">
                                            {{ $modification->getAlias() }}
                                            <br>
                                            <small class="{{ $modification->active ? 'text-info' : 'text-muted' }}">
                                                {{ $modification->active ? 'Pending' : 'Processed' }}
                                            </small>
                                        </td>

                                        <td class="text-wrap">
                                            {{ $modification->description }}
                                            @if ($modification->approvals->count())
                                                <br>
                                                <small class="text-muted">
                                                    Approved By
                                                </small>
                                                {{-- list all approvals here --}}
                                                @foreach ($modification->approvals as $approval)
                                                    <small class="text-info">
                                                        {{ $approval->user['name'] }}
                                                        {{ $approval->created_at->diffForHumans() }}
                                                        @if ($modification->approvals->count() > 1)
                                                            ,
                                                        @endif
                                                    </small>
                                                @endforeach
                                            @endif

                                            @if ($modification->disapprovals->count())
                                                <br>
                                                <small class="text-muted">
                                                    Disapproved By
                                                </small>
                                                {{-- list all approvals here --}}
                                                @foreach ($modification->disapprovals as $disapproval)
                                                    <small class="text-danger">
                                                        {{ $disapproval->user['name'] }}
                                                        {{ $disapproval->created_at->diffForHumans() }}
                                                    </small>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="text-wrap">
                                            {{ $modification->user['name'] }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $modification->user->department['name'] }}
                                            </small>
                                            <br>
                                            <small class="text-info">
                                                {{ Carbon\Carbon::create($modification->created_at)->diffForHumans() }}
                                            </small>
                                        </td>

                                        <td class="text-wrap">
                                            {{ $modification->approvals()->count() . ' / ' . $modification->approvers_required }}
                                        </td>

                                        <td class="text-wrap">
                                            {{ $modification->disapprovals()->count() . ' / ' . $modification->disapprovers_required }}
                                        </td>
                                    </tr>
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
</div>
