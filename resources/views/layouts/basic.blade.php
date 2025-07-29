<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.header')
@include('layouts.partials.loader')

<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
