<div>
    @include('livewire.monitor-jobs.partials.heading-cards')

    <div class="row mt-1 mb-3">
        <div class="btn-group">
            <button class="btn btn-primary btn-sm" type="button" wire:click="callRunMaintenance('updateEmployeeDetails')">
                Update Employees
            </button>
            <button class="btn btn-danger btn-sm" type="button"
                wire:click="callRunMaintenance('runCustomerMonthlyReport')">
                Customer Monthly Reports
            </button>
            <button class="btn btn-danger btn-sm" type="button" wire:click="callRunMaintenance('approveAllPending')">
                Approve all requests
            </button>
            <button class="btn btn-info btn-sm" type="button" wire:click="retryAll()">
                Rety All
            </button>
            <button class="btn btn-dark btn-sm" type="button" wire:click="flushQueue()">
                Flush Queue
            </button>
            <button class="btn btn-primary btn-sm" type="button" wire:click="optimizeBatch()">
                Optimize Batch
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('livewire.monitor-jobs.partials.failed-jobs')
        </div>
    </div>
</div>
@push('before-scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            $(".loading-zone").addClass("hidden"); //Hide Loader
        });
    </script>
@endpush
