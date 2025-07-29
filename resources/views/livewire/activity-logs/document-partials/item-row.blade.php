<tr align="left">
    <td>
        00{{ $ps->employee['id'] }}
    </td>
    <td>
        {{ $ps->employee->name() }}
    </td>
    <td>
        Ksh. {{ $ps->gross }}
    </td>
    <td>
        Ksh. {{ $ps->bonuses }}
    </td>
    <td>
        - Ksh. {{ $ps->getGearCost()->sum('amount') }}
    </td>
    <td>
        - Ksh. {{ $ps->advances()->sum('amount') }}
    </td>
    <td>
        - Ksh. {{ $ps->statutory_deductions }}
    </td>
    <td>
        Ksh. {{ $ps->net }}
    </td>
</tr>
