<tr>
    <td>
        {{ $document->type['name'] }}
        <br>
        <small class="text-muted">
            {{ $document->original_received == 1 ? 'Original' : 'Copy' }}
        </small>
    </td>
    <td class="text-wrap">
        {{ $document->getSize() }}
    </td>
    <td>
        {{ $document->mime_type }}
    </td>
    <td class="text-wrap">
        {{ $document->documentable->name }}
    </td>
    <td class="text-wrap">
        {{ date_format($document->created_at, 'Y M d H:m:s') }}
    </td>
    <td>

        <a href="{{ route('documents.download', ['document' => $document]) }}" class="btn btn-xs btn-info">
            <i class="mdi mdi-download"></i>
        </a>

        <a href="{{ route('documents.delete', ['document' => $document]) }}" class="btn btn-xs btn-danger">
            <i class="mdi mdi-delete"></i>
        </a>

    </td>
</tr>
