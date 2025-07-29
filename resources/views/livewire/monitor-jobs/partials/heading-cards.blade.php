<div class="row" wire:poll.20s="loadCounts">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card shadow bg-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Pending Jobs
                    <i class="mdi mdi-timetable mdi-48px float-end"></i>
                </h4>
                <h3 class="mb-5">
                    {{ number_format($failed_job_count) }}&nbsp;Jobs
                </h3>
                <h6 class="card-text">
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-sm">
                        Dashboard
                    </a>
                </h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card shadow bg-primary card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Failed Jobs
                    <i class="mdi mdi-book-open-page-variant mdi-48px float-end"></i>
                </h4>
                <h3 class="mb-5">
                    {{ number_format($failed_job_count) }}&nbsp;Jobs
                </h3>
                <h6 class="card-text">
                    <a href="{{ route('jobs.failed') }}" class="btn btn-info btn-sm">
                        Failed Jobs
                    </a>
                </h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card shadow bg-dark card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Running Jobs
                    <i class="mdi mdi-periscope mdi-48px float-end"></i>
                </h4>
                <h3 class="mb-5">
                    {{ number_format($running_job_count) }}&nbsp;Jobs
                </h3>
            </div>
        </div>
    </div>
</div>
