<tr align="left">
    <th class="text-bold" colspan="2">
        Earnings
    </th>
</tr>

<tr align="left">
    <td>
        Gross Pay
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->gross }}
    </td>
</tr>

<tr align="left">
    <td>
        Position Bonus(s)
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->bonuses }}
    </td>
</tr>

<tr align="left">
    <th class="text-bold" colspan="2">
        Statutory Deductions
    </th>
</tr>

<tr align="left">
    <td>
        NSSF
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->nssf }}
    </td>
</tr>

<tr align="left">
    <td>
        NHIF
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->nhif }}
    </td>
</tr>

<tr align="left">
    <td>
        PAYE
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->paye }}
    </td>
</tr>

<tr align="left">
    <th class="text-bold" colspan="2">
        Other Deductions
    </th>
</tr>

<tr align="left">
    <td>
        Advance Pay Deduction
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->advance_deductions }}
    </td>
</tr>

<tr align="left">
    <td>
        Assigned Gear Deduction
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->gear_deductions }}
    </td>
</tr>

<tr align="left">
    <th class="text-bold" colspan="2">
        Summary
    </th>
</tr>

<tr align="left">
    <td>
        Days Worked
    </td>
    <td>
        {{ $payslip->days_earned }}
    </td>
</tr>

<tr align="left">
    <td>
        Total Deductions
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->gross - $payslip->net }}
    </td>
</tr>

<tr align="left">
    <td>
        Net Pay
    </td>
    <td>
        <b>
            Ksh.
        </b>
        {{ $payslip->net }}
    </td>
</tr>

<tr align="left">
    <td>
        Payment Method
    </td>
    <td>
        {{ $payslip->employee->paymentMethod['name'] }}
    </td>
</tr>


{{-- print bank info if it exists --}}
@if ($payslip->employee->bankAccounts()->count() && $payslip->employee->paymentMethod['name'] == 'Bank')
    <tr align="left">
        <th class="text-bold" colspan="2">
            Bank Account Details
        </th>
    </tr>

    <tr align="left">
        <td>
            Bank Name
        </td>
        <td>
            {{ $payslip->employee->bankAccounts()->first()->bank['name'] }}
        </td>
    </tr>

    <tr align="left">
        <td>
            Branch Name
        </td>
        <td>
            {{ $payslip->employee->bankAccounts()->first()['bank_branch'] }}
        </td>
    </tr>

    <tr align="left">
        <td>
            Account Name
        </td>
        <td>
            {{ $payslip->employee->bankAccounts()->first()['acc_name'] }}
        </td>
    </tr>

    <tr align="left">
        <td>
            Account Number
        </td>
        <td>
            {{ $payslip->employee->bankAccounts()->first()['acc_number'] }}
        </td>
    </tr>
@endif
