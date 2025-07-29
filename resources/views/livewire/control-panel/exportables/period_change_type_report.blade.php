<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                #
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                CHANGE TYPE
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                DESCRIPTION
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                REQUESTED BY
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                APPROVED BY
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                DISAPPROVED BY
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                TIME REQUESTED
            </th>
            <th bgcolor="yellow" style="vertical-align:middle;height:35px;font-weight:bolder">
                STATUS
            </th>
        </tr>
        @foreach ($modifications as $modification)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $modification->getAlias() }}
                </td>
                <td>
                    {{ $modification->description }}
                </td>
                <td>
                    @if ($modification->user)
                        {{ $modification->user['name'] }}
                    @endif
                </td>
                <td>
                    @if ($modification->approvals_count)
                        {{-- list all approvals here --}}
                        @foreach ($modification->approvals as $approval)
                            <small class="text-info">
                                {{ $approval->user['name'] }} {{ $approval->created_at->diffForHumans() }}
                            </small>
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($modification->disapprovals_count)
                        {{-- list all approvals here --}}
                        @foreach ($modification->disapprovals as $disapproval)
                            <small class="text-danger">
                                {{ $disapproval->user['name'] }} {{ $disapproval->created_at->diffForHumans() }},
                            </small>
                        @endforeach
                    @endif
                </td>
                <td>
                    {{ Carbon\Carbon::create($modification->created_at)->diffForHumans() }}
                </td>
                <td>
                    {{ $modification->active ? 'Pending' : 'Processed' }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
