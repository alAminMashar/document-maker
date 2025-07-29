<div>
    @include('livewire.monitor-jobs.partials.heading-cards')
    <div class="row">
        <div class="col-12">
            @include('livewire.monitor-jobs.partials.pending-jobs')
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
