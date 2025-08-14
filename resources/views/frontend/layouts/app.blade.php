<!doctype html>
<html class="no-js" lang="en">

@include('frontend.layouts.partials.header')

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/img/logo/loader.png') }}" alt="loading image">
                </div>
            </div>
        </div>
    </div>

    <!-- Preloader Start -->
    @include('frontend.navigation.main')
    <main>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> There was an issue with your inputs. Please try again.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @yield('content')
    </main>

    {{-- @push('modals')
        @include('modals.rfq')
    @endpush --}}

    @include('frontend.layouts.partials.footer')

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
    @include('frontend.layouts.partials.scripts')

</body>

{{-- Yield all modals from this point --}}
@stack('modals')

</html>
