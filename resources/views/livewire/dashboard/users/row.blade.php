<tr>
    <td class="text-wrap">
        {{ $user->name }}
    </td>
    <td class="text-wrap">
        {{ $user->active == 1 ? 'Active' : 'Inactive' }}
    </td>
    <td class="text-wrap">
        {{ $user->created_at->diffForHumans() }}
    </td>
</tr>
