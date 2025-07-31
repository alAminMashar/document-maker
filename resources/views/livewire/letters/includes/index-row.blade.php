<tr>
    <td class="text-wrap">
        {{ $loop->iteration }}
    </td>
    <td class="text-wrap">
        {{ $letter->title }}
    </td>
    <td class="text-wrap">
        {{ \Carbon\Carbon::parse($letter->created_at)->format('d/m/Y') }}
    </td>
    <td class="text-wrap">
        {{ \Carbon\Carbon::parse($letter->published_at)->format('d/m/Y') }}
    </td>
    <td class="text-wrap">
        {{ $letter->published ? 'Published' : 'Not Published' }}
    </td>
    <td>
        @include('livewire.letters.includes.row-actions')
    </td>
</tr>
