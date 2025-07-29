 <!-- partial:partials/_navbar.html -->
 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
     <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
             <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" />
         </a>
         <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
             <img src="{{ asset('assets/images/logo/logo-mini.png') }}" alt="logo" />
         </a>
     </div>
     <div class="navbar-menu-wrapper d-flex align-items-stretch">
         <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
             <span class="mdi mdi-menu"></span>
         </button>
         {{-- @stack('nav-search') --}}

         <ul class="navbar-nav navbar-nav-right">
             {{-- @include('navigation._messages') --}}

             @if (Auth::user()->notifications->count() > 0)
                 @include('navigation._notifications')
             @endif

             <li class="nav-item d-none d-lg-block full-screen-link">
                 <a class="nav-link">
                     <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                 </a>
             </li>

             @auth
                 @include('navigation._nav-profile-top')
             @endauth

         </ul>
     </div>
 </nav>
 <!-- partial -->
