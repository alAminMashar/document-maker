<!-- Modal -->
<div class="modal fade show" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addUserModalLabel" aria-hidden="false" style="display:block;">
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel"></h5>
                <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (isset($importUsers) && $importUsers)
                    @include('livewire.user.includes.add-document')
                @else
                    @include('livewire.user.includes.user-form')
                @endif
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Understood
                </button>
            </div>
        </div>
    </div>
</div>
