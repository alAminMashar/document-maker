<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        @auth
            @include('navigation._nav-profile-side')
        @endauth

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#dashboard" aria-expanded="false" aria-controls="dashboard">
                <span class="menu-title">
                    Dashboard
                </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
            <div class="collapse" id="dashboard">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('help-guide.index') }}">
                            System Guides
                        </a>
                    </li>
                    @if (auth()->user()->canany(['control-panel.index', 'control-panel.history']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('control-panel.index') }}">
                                Control Panel
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasRole('Super Admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.index') }}">
                                Jobs Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.failed') }}">
                                Failed Jobs
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>


        @if (auth()->user()->canany(['political.party.index', 'candidate.index', 'polls.index', 'voters.index']))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#polls-menu" aria-expanded="false"
                    aria-controls="polls-menu">
                    <span class="menu-title">
                        Manage Polls
                    </span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-vector-selection menu-icon"></i>
                </a>
                <div class="collapse" id="polls-menu">
                    <ul class="nav flex-column sub-menu">
                        @if (auth()->user()->can('polls.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('polls.index') }}">
                                    Polls
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('candidates.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('candidates.index') }}">
                                    Candidates
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('voters.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('voters.index') }}">
                                    Voters
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('political.party.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('political.party.index') }}">
                                    Parties
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif


        @if (auth()->user()->canany(['letter.index', 'letter.verify']))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#letters" aria-expanded="false"
                    aria-controls="letters">
                    <span class="menu-title">
                        Letters Manager
                    </span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-message-reply-text menu-icon"></i>
                </a>
                <div class="collapse" id="letters">
                    <ul class="nav flex-column sub-menu">
                        @if (auth()->user()->can('letter.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('letter.index') }}">
                                    Letters
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('letter.design'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('letter.design') }}">
                                    Design Letter
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif


        @if (auth()->user()->canany(['users', 'role.index', 'permissions']))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                </a>
                <div class="collapse" id="user">
                    <ul class="nav flex-column sub-menu">
                        @if (auth()->user()->can('users'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users') }}">
                                    Users
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('role.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('role.index') }}">
                                    Roles
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasRole('Super Admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('permissions') }}">
                                    Permissions
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif

        @if (auth()->user()->hasRole('Super Admin'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#sandbox" aria-expanded="false"
                    aria-controls="sandbox">
                    <span class="menu-title">Sandbox</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-xbox-controller menu-icon"></i>
                </a>
                <div class="collapse" id="sandbox">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('design.sandbox') }}">
                                Design
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sms.sandbox') }}">
                                SMS
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        @if (auth()->user()->canany(['document-types.index']))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false"
                    aria-controls="settings">
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-settings menu-icon"></i>
                </a>
                <div class="collapse" id="settings">
                    <ul class="nav flex-column sub-menu">
                        @if (auth()->user()->can('document-types.index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('document-types.index') }}">
                                    Document Types
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif

    </ul>
</nav>
<!-- partial -->
