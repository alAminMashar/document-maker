@if (Auth::user()->unreadNotifications()->count() > 0)
    <div class="dropdown-divider"></div>
    @foreach (Auth::user()->unreadNotifications()->take(5)->get() as $notification)
        <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="preview-subject font-weight-normal mb-1">
                    {{ App\Models\Helpers::mb_basename($notification->type) }}
                </h6>
                <p class="text-gray ellipsis mb-0">
                    {{ $notification->data['data'] }}
                </p>
            </div>
        </a>
        <div class="dropdown-divider"></div>
    @endforeach
@else
    <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
            <div class="preview-icon bg-success">
                <i class="mdi mdi-calendar"></i>
            </div>
        </div>
        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
            <h6 class="preview-subject font-weight-normal mb-1">
                All Caught Up
            </h6>
            <p class="text-gray ellipsis mb-0">
                No unread notifications
            </p>
        </div>
    </a>
    <div class="dropdown-divider"></div>
@endif
