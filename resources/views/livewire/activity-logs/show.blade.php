<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="sample-wire-information-tab" data-bs-toggle="tab"
                data-bs-target="#sample-wire-information" type="button" role="tab"
                aria-controls="sample-wire-information" aria-selected="true">
                <span class="fw-bold text-primary">
                    Personal Information
                </span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dispatch-requests-tab" data-bs-toggle="tab" data-bs-target="#dispatch-requests"
                type="button" role="tab" aria-controls="dispatch-requests" aria-selected="false">
                <span class="fw-bold text-primary">
                    Dispatch Requests
                </span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments"
                type="button" role="tab" aria-controls="assignments" aria-selected="false">
                <span class="fw-bold text-primary">
                    Dispatched Assignments
                </span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="statements-tab" data-bs-toggle="tab" data-bs-target="#statements"
                type="button" role="tab" aria-controls="statements" aria-selected="false">
                <span class="fw-bold text-primary">
                    Statements
                </span>
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="sample-wire-information" role="tabpanel"
            aria-labelledby="sample-wire-information-tab">
            @include('livewire.sample-wire.components.information')
        </div>

        <div class="tab-pane fade" id="dispatch-requests" role="tabpanel" aria-labelledby="dispatch-requests-tab">
            @include('livewire.sample-wire.components.dispatch')
        </div>

        <div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignments-tab">
            @include('livewire.sample-wire.components.assignments')
        </div>

        <div class="tab-pane fade" id="statements" role="tabpanel" aria-labelledby="statements-tab">
            @include('livewire.sample-wire.components.statements')
        </div>
    </div>

</div>
