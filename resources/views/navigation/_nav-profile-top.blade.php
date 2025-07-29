 <li class="nav-item nav-profile dropdown">
     <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
         <div class="nav-profile-img d-nones">
             <i class="mdi mdi-face-profile"></i>
             {{-- <span class="availability-status online"></span> --}}
         </div>
         <div class="nav-profile-text">
             <p class="mb-1 text-black">
                 {{ Auth::user()->name }}
             </p>
         </div>
     </a>
     <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
         <a class="dropdown-item text-muted" href="{{ route('users.profile', ['user' => auth()->user()]) }}">
             <i class="mdi mdi-face-profile me-2 text-primary"></i>
             Profile Settings
         </a>
         <a class="dropdown-item text-muted" href="{{ route('notifications') }}">
             <i
                 class="mdi mdi-bell-ring{{ Auth::user()->unreadNotifications->count() > 0 ? ' text-success' : '-outline' }} me-2 text-primary"></i>
             Notifications
         </a>
         @if (auth()->user()->can('activity.index'))
             <a class="dropdown-item text-muted" href="{{ route('activity.index') }}">
                 <i class="mdi mdi-altimeter me-2 text-primary"></i>
                 Activity Logs
             </a>
         @endif

         {{-- <div class="dropdown-divider"></div> --}}
         <a class="dropdown-item text-muted" href="{{ route('logout') }}">
             <i class="mdi mdi-logout me-2 text-primary"></i>
             Sign Out
         </a>
     </div>
 </li>
