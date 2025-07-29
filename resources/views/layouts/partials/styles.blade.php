@notifyCss
@stack('before-styles')
<!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->
<!-- Plugin css for this page -->
<!-- End plugin css for this page -->
{{-- <link rel="stylesheet" href="assets/css/style.css"> --}}
<link rel="stylesheet" href="{{ asset('build/manifest.json') }}">
<link rel="stylesheet" href="{{ asset('build/assets/style-96f52df5.css') }}">
{{-- @vite('resources/assets/scss/style.scss') --}}
@livewireStyles
@stack('after-styles')
<style>
    .scrollable-table {
        overflow-x: auto;
        width: 100%;
    }
</style>
