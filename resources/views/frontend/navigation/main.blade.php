<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header">
            <div class="header-top d-none d-lg-block">
                <div class="container-fluid">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left d-flex">
                                <ul>
                                    <li>
                                        {{ config('app.name') }}
                                    </li>
                                    <li>Phone: {{ config('app.phone') }}</li>
                                    <li>Email: {{ config('app.email') }}</li>
                                </ul>
                                <div class="header-social d-nones">
                                    <ul>
                                        {{-- @include('frontend.shared.social-links') --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="organisation logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li>
                                                <a href="{{ route('home') }}">
                                                    Home
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.polls') }}">
                                                    Polls
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<!-- header end -->
