<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button"
                role="tab" aria-controls="index" aria-selected="true">
                <span class="fw-bold text-primary">
                    Records
                </span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button"
                role="tab" aria-controls="reports" aria-selected="false">
                <span class="fw-bold text-primary">
                    Reports
                </span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
            @include('livewire.aged-receivables.pages.show-main')
        </div>

        <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
            @include('livewire.aged-receivables.pages.reports')
        </div>
    </div>
</div>
