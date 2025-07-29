<div class="col-lg-12 grid-margin stretch-card" wire:poll.20s="loadPendingJobs">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Pending Jobs
            </h4>
            <p>
                <small class="card-description fs-11">
                    View and manage all pending Jobs
                </small>
            </p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job Name</th>
                        <th>Queue</th>
                        <th>Attempts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending_jobs as $job)
                        <tr>
                            <td class="text-wrap">{{ $job['id'] }}</td>
                            <td class="text-wrap">{{ class_basename($job['displayName']) }}</td>
                            <td class="text-wrap">{{ $job['queue'] }}</td>
                            <td class="text-wrap">{{ $job['attempts'] }}</td>
                            <td class="text-wrap">
                                <button class="btn btn-primary btn-sm" onclick="toggleDetails('{{ $job['id'] }}')">
                                    View Details
                                </button>
                            </td>
                        </tr>
                        <tr id="details-{{ $job['id'] }}" style="display: none;">
                            <td class="text-wrap" colspan="5">
                                <pre>{{ json_encode($job['data'], JSON_PRETTY_PRINT) }}</pre>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-12 mt5">
                    {{-- {{ $pending_jobs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function toggleDetails(id) {
            let detailsRow = document.getElementById('details-' + id);
            detailsRow.style.display = (detailsRow.style.display === 'none') ? '' : 'none';
        }
    </script>
@endpush
