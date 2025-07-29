<tr>
    <td class="text-wrap" wire:click="showNotification({{ $notification }})">
        <span
            class="mdi mdi-{{ $notification->read_at != null ? 'bookmark-check text-muted' : 'bookmark-remove text-info' }}">
            {{ $notification->read_at != null ? 'Read' : 'Unread' }}
        </span>
        &nbsp;
        <small class="text-muted float-end">
            {{ $notification->created_at->diffForHumans() }}
        </small>
        <br>
        <p class="{{ $notification->read_at == null ? 'fw-bolders' : 'fw-light' }}">
            {{ $notification->data['data'] }}
        </p>
        <br>
        <small class="text-muted">
            {{ App\Models\Helpers::mb_basename($notification->type) }}
        </small>
    </td>
    <td>
        {{-- <button class="btn btn-primary btn-xs" wire:click="showNotification({{ $notification }})" title="Open to read">
            <i class="mdi mdi-eye"></i>
        </button> --}}
        @if ($notification->read_at == null)
            <button wire:click="readOne({{ $notification }})" class="btn btn-success btn-xs" title="Mark as Read">
                <i class="mdi mdi mdi-read"></i>
                Mark as Read
            </button>
        @else
            <button wire:click="unreadOne({{ $notification }})" class="btn btn-dark btn-xs" title="Mark as Unread">
                <i class="mdi mdi mdi-close"></i>
                Mark as Unread
            </button>
        @endif

    </td>
</tr>
