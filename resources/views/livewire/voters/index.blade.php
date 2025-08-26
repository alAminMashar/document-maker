<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="voters-label">
                <span class="fw-bold text-primary">
                    voters
                </span>
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="voters-tab" role="tabpanel" aria-labelledby="voters-label">
            @include('livewire.voters.tabs.voters')
            @include('livewire.voters.tabs.documents')
        </div>
    </div>
</div>
