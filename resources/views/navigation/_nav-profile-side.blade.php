<li class="nav-item nav-profile">
    <a href="#" class="nav-link">
        <div class="nav-profile-image d-none">
            {{-- <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile"> --}}
            <span class="login-status offline"></span>
            <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">
                {{ Auth::user()->name }}
            </span>
            <span class="text-secondary text-small">
                {{-- {{ Auth::user()->role['name'] }} --}}
            </span>

        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
    </a>
</li>
