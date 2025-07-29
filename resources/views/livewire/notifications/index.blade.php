<div>
    <div class="col-md-12">
        @if ($openNotification)
            @include('livewire.notifications.includes.create-modal')
        @endif
    </div>

    @include('livewire.notifications.components.search-canvas')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">
                    Notifications
                </h4>

                <p class="card-description">
                    You have <b class="fw-bolder">
                        {{ Auth::user()->unreadNotifications->count() }}
                    </b>
                    unread notifications.

                <div class="dropdown">
                    <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="filterNotifications"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mdi mdi-filter"></span>
                        Filter Notifications
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterNotifications">
                        <li>
                            <a class="dropdown-item text-primary" wire:click="statusFilter({{ 1 }})">
                                {{ $unread_notifications }} Unread
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-primary" wire:click="statusFilter({{ 2 }})">
                                {{ $read_notifications }} Read
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-primary" wire:click="statusFilter({{ 3 }})">
                                {{ $all_notifications }} All
                            </a>
                        </li>
                    </ul>
                </div>
                </p>


                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($notifications)
                            @foreach ($notifications as $notification)
                                @include('livewire.notifications.includes.item-row', $notification)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center">
                                    No Records Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="col">
                        {{ $notifications->links() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if ($notifications->count() > 0)
                            <button wire:click="readAll()" class="btn btn-success btn-xs">
                                <i class="mdi mdi mdi-read"></i>
                                Mark All As Read
                            </button>
                            <button wire:click="clearAll()" class="btn btn-danger btn-xs ">
                                <i class="mdi mdi-delete-sweep"></i>
                                Clear Notifications
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
