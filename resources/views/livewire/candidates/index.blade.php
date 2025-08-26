<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="candidates-label">
                <span class="fw-bold text-primary">
                    Candidates
                </span>
            </button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="candidates-tab" role="tabpanel" aria-labelledby="candidates-label">
            @include('livewire.candidates.tabs.candidates')
            @include('livewire.candidates.tabs.documents')
        </div>

    </div>
</div>
