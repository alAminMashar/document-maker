<tr>
    <td class="text-wrap">
        <span class="text-muted">
            [{{ $account->customer->code }}]&nbsp;
        </span>
        {{ $account->customer->name }}
        <br>
        <small class="text-info">
            {{ $account->customer->creditTerm ? $account->customer->creditTerm->describe() : 'No Credit Term' }}
        </small>
    </td>
    <td class="text-wrap">
        <b>
            {{ number_format($account['balance_due'], 2) }}
        </b>
    </td>
    <td class="text-wrap">
        {{ number_format($account['current'], 2) }}
    </td>
    <td class="text-wrap">
        {{ number_format($account['30_days'], 2) }}
    </td>
    <td class="text-wrap">
        {{ number_format($account['60_days'], 2) }}
    </td>
    <td class="text-wrap">
        {{ number_format($account['90_days'], 2) }}
    </td>
    <td class="text-wrap">
        {{ number_format($account['120_days'], 2) }}
    </td>
    <td>
        <div class="btn-group btn-sm" role="group">
            @if (auth()->user()->can('aged-receivables.show'))
                <button class="btn btn-sm btn-info" wire:click="refreshAccount({{ $account->id }})"
                    title="Refresh Account">
                    <span class="mdi mdi-refresh"></span>
                </button>
                <a href="{{ route('customer.show', ['customer' => $account->customer]) }}"
                    class="btn btn-sm btn-primary" title="View Customer">
                    {{-- <span class="mdi mdi-eye"></span> --}}
                    Customer
                </a>
            @endif
        </div>
    </td>
</tr>
