 @if(Auth::user()->unreadNotifications->count())
    <li class="nav-item">
        <a href="{{ route('notifications') }}" class="nav-link count-indicator">
            <i class="mdi mdi-bell-ring{{ Auth::user()->unreadNotifications->count() > 0 ? ' text-success' : '-outline' }} me-2 text-primary"></i>
            <span class="count-symbol bg-danger"></span>
        </a>
    </li>
@endif


{{-- @if(Auth::user()->unreadNotifications()->count())
 <li class="nav-item dropdown">
     <a class="nav-link count-indicator dropdown-toggle"
         id="notificationDropdown" href="#" data-bs-toggle="dropdown">
         <i class="mdi mdi-bell-outline"></i>
         <span class="count-symbol bg-danger"></span>
     </a>
     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
         <h6 class="p-3 mb-0">
             Notifications
             &nbsp;
             <span class="badge badge-info">
                 {{ Auth::user()->unreadNotifications()->count() }}
             </span>
         </h6>
         <div>
             @include('navigation.notifications-preview')
         </div>
         <h6 class="p-3 mb-0 text-center">
             <a href="{{ route('notifications') }}">
                 See all notifications
             </a>
         </h6>
     </div>
 </li>
@endif --}}
