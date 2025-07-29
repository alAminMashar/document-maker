<tr>
    <td>
        {{ $log->id }}
    </td>
    <td class="text-wrap">
        @if ($log->user)
            <b>{{ $log->user['name'] }} &nbsp;</b>
            <small>
                ({{ $log->user->department['name'] }})
            </small>
        @else
            <b>System Action</b>
        @endif
        <br>
        <span>
            {{ $log->description }}:
            {{ $log->type() }}
        </span>
    </td>
    <td class="text-wrap">
        @foreach ($log->properties as $property)
            @foreach ($property as $k => $v)
                <div class="text-capitalize">
                    <small class="text-bold">
                        <b>{{ $k }} :</b>
                    </small>
                    {{ $v }}
                </div> <br>
            @endforeach
        @endforeach
    </td>
    <td>
        {{ date_format($log->created_at, 'd M Y @ H:i:s') }}
    </td>
</tr>

