<div class="col-lg-12 grid-margin stretch-card" wire:poll.20s="loadFailedJobs">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Failed Jobs
            </h4>
            <p>
                <small class="card-description fs-11">
                    View and manage all failed Jobs
                </small>
            </p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job Name</th>
                        <th>Queue</th>
                        <th>Failed At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($failed_jobs as $job)
                        @include('livewire.monitor-jobs.partials.job-row')
                    @endforeach
                </tbody>
            </table>

            <br><br>

            <div class="row">
                <div class="col">
                    {{-- {{ $failed_jobs->links() }} --}}
                </div>
            </div>

        </div>
    </div>
</div>
