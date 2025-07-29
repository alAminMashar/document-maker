<tr>
    <td class="text-wrap">
        {{ $loop->iteration }}
    </td>
    <td class="text-wrap">
        {{ $modification->getAlias() }}
        <br>
        <small class="{{ $modification->active ? 'text-info' : 'text-muted' }}">
            {{ $modification->active ? 'Pending' : 'Processed' }}
        </small>
    </td>

    <td class="text-wrap">
        {{ $modification->description }}
        @if ($modification->approvals->count())
            <br>
            <small class="text-muted">
                Approved By
            </small>
            {{-- list all approvals here --}}
            @foreach ($modification->approvals as $approval)
                <small class="text-info">
                    {{ $approval->user['name'] }} {{ $approval->created_at->diffForHumans() }}
                    @if ($modification->approvals->count() > 1)
                        ,
                    @endif
                </small>
            @endforeach
        @endif

        @if ($modification->disapprovals->count())
            <br>
            <small class="text-muted">
                Disapproved By
            </small>
            {{-- list all approvals here --}}
            @foreach ($modification->disapprovals as $disapproval)
                <small class="text-danger">
                    {{ $disapproval->user['name'] }} {{ $disapproval->created_at->diffForHumans() }}
                </small>
            @endforeach
        @endif
    </td>

    <td class="text-wrap">
        {{ $modification->user['name'] }}
        <br>
        <small class="text-muted">
            {{ $modification->user->department['name'] }}
        </small>
        <br>
        <small class="text-info">
            {{ Carbon\Carbon::create($modification->created_at)->diffForHumans() }}
        </small>
    </td>

    <td class="text-wrap">
        {{ $modification->approvals()->count() . ' / ' . $modification->approvers_required }}
    </td>

    <td class="text-wrap">
        {{ $modification->disapprovals()->count() . ' / ' . $modification->disapprovers_required }}
    </td>

    <td class="text-wrap">
        @if (!$modification->deletable())
            @if ($modification->active == 1)
                <div class="btn-group btn-xs col {{ $modification->active == 0 ? 'd-none' : '' }}" role="group">

                    @if ($modification->uniqueApproval() || auth()->user()->can('overide-approve'))
                        <button class="btn btn-sm btn-success" wire:click="approve({{ $modification->id }})">
                            Approve
                        </button>
                    @endif

                    @if ($modification->uniqueDisapproval() || auth()->user()->can('overide-approve'))
                        <button class="btn btn-sm btn-danger" wire:click="disapprove({{ $modification->id }})">
                            Disapprove
                        </button>
                    @endif

                </div>
            @endif
        @else
            @if ($modification->active == 1)
                <div class="btn-group btn-xs col" role="group">
                    <button id="deleteDropDownButton{{ $modification->id }}" type="button"
                        class="btn btn-danger btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-delete"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="deleteDropDownButton{{ $modification->id }}">
                        <li>
                            <button class="dropdown-item" wire:click="deleteModification({{ $modification->id }})">
                                <i class="mdi mdi-delete"></i>
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
            @endif
        @endif


    </td>
</tr>
