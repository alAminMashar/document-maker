    <div class="row">

        @if (auth()->user()->can('users'))
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card shadow bg-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Users
                            <i class="mdi mdi-book-open-page-variant mdi-48px float-end"></i>
                        </h4>
                        <h3 class="mb-5">

                        </h3>
                        <h6 class="card-text">
                            <a href="{{ route('users') }}" class="btn btn-primary btn-sm">
                                Open
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        @endif

    </div>
