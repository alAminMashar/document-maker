<tr>
    <td class="text-wrap">
        {{ $period['slug'] }}
    </td>
    <td class="text-wrap">
        {{ $period->agedAccounts->count() }} Customers
    </td>
    <td>
        <div class="btn-group btn-sm" role="group">
            @if (auth()->user()->can('aged-receivables.show'))
                <a href="{{ route('aged-receivables.show', ['period' => $period]) }}" class="btn btn-info btn-sm">
                    <i class="mdi  mdi-eye"></i>
                    View Reports
                </a>
            @endif
        </div>
    </td>
</tr>
