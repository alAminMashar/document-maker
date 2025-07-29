<tr>
    <td class="text-wrap">{{ $job['id'] }}</td>
    <td class="text-wrap">{{ class_basename($job['displayName']) }}</td>
    <td class="text-wrap">{{ $job['queue'] }}</td>
    <td class="text-wrap">{{ $job['failed_at'] }}</td>
    <td class="text-wrap">
        <button class="btn btn-primary btn-sm" wire:click="toggleDetails({{ $job['id'] }})">
            View Details
        </button>
        <button class="btn btn-danger btn-sm" wire:click="retryJob('{{ $job['uuid'] }}')">
            Retry
        </button>
    </td>
</tr>
@if (isset($expandedJobId) && $expandedJobId === $job['id'])
    <tr>
        <td class="text-wrap" colspan="5">
            <strong>Exception:</strong>
            <pre>{{ $job['exception'] }}</pre>
            <strong>Payload:</strong>
            <pre>{{ json_encode($job['data'], JSON_PRETTY_PRINT) }}</pre>
        </td>
    </tr>
@endif
