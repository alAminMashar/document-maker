<div>
    @if ($updateRole)
        @include('livewire.roles.includes.update-modal')
    @endif

    @include('livewire.roles.components.search-canvas')

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions"
                type="button" role="tab" aria-controls="permissions" aria-selected="false">
                <span class="fw-bold text-primary">
                    Current Permissions
                </span>
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button"
                role="tab" aria-controls="details" aria-selected="false">
                <span class="fw-bold text-primary">
                    Details
                </span>
            </button>
        </li>

        @if (!$updateRole)
            <li class="nav-item">
                <button class="btn btn-primary btn-sm" type="button" wire:click="editRole({{ $role->id }})">
                    Update Permissions
                </button>
            </li>
        @endif

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
            @include('livewire.roles.components.permissions')
        </div>

        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
            @include('livewire.roles.components.information')
        </div>
    </div>

</div>
