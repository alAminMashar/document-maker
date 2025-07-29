<tr>
    <td>
        {{ $permission->name }}
    </td>
    <td>
        {{ $permission->created_at }}
    </td>
    <td>
        <button class="btn btn-sm btn-danger" wire:click="removePermission({{ $permission->id }})">
            <span class="mdi mdi-delete-forever"></span>
        </button>
    </td>
</tr>
