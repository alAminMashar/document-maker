<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.header')
@include('layouts.partials.loader')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="canon-wrap d-flex align-items-center auth">
                <div class="tint"></div>
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.partials.scripts')
</body>

</html>
