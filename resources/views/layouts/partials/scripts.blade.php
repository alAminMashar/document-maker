@livewireScripts()
<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- Load CKEditor 5 -->
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/n8vz3n35y1z2d2ou9jmz2twtfjktmjroen2vjxe777if6z29/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- endinject -->
{{-- Any additional scripts --}}
@include('layouts.partials.toast-scripts')
@stack('before-scripts')
@stack('scripts')
