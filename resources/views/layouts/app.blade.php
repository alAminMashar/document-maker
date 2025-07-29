<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.header')

@include('layouts.partials.loader')

<body class="sidebar-icon-only">
    <div class="container-scroller">
        @include('navigation._top')
        <div class="container-fluid page-body-wrapper">
            @include('navigation._sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('layouts.partials.page-header')
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                @include('layouts.partials.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.partials.scripts')
    <x-notify::notify />
    @notifyJs
</body>

</html>
