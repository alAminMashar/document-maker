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
<link rel="stylesheet" href="{{ asset('build/assets/style-0f89eac9.css') }}">
<script type="module" src="{{ asset('build/assets/app-3191fba5.js') }}"></script>
{{-- @vite(['resources/assets/scss/style.scss', 'resources/assets/js/app.js']) --}}

@livewireStyles
@stack('after-styles')
<style>
    .scrollable-table {
        overflow-x: auto;
        width: 100%;
    }
</style>
