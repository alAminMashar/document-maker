@include('livewire.dashboard.components.charts')
@push('scripts')
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <!-- End custom js for this page -->
    <!-- endinject -->
@endpush
