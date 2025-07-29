<div class="table-section bill-tbl w-100 mt-10">

    <div>
        <table class="table w-50 float-left">
            <tr>
                <th colspan="2">
                    Employee Information
                </th>
            </tr>

            <tr align="left">
                <td>
                    <small class="text-bold">
                        Name
                    </small>
                </td>
                <td>
                    {{ $payslip->employee->name() }}
                </td>
            </tr>

            <tr align="left">
                <td>
                    <small class="text-bold">
                        National ID
                    </small>
                </td>
                <td>
                    {{ $payslip->employee['id_number'] }}
                </td>
            </tr>

            <tr align="left">
                <td>
                    <small class="text-bold">
                        Phone Number
                    </small>
                </td>
                <td>
                    {{ $payslip->employee['phone'] }}
                </td>
            </tr>

            <tr align="left">
                <td>
                    <small class="text-bold">
                        KRA PIN
                    </small>
                </td>
                <td>
                    {{ $payslip->employee['kra_pin'] }}
                </td>
            </tr>

        </table>
    </div>

    <div>
        <table class="table w-50 float-right">
            <tr>
                <th colspan="2">
                    Payslip Information
                </th>
            </tr>

            <tr align="left">
                <td>
                    <small class="text-bold">
                        Payroll Number
                    </small>
                </td>
                <td>
                    00{{ $payslip->payroll['id'] }}
                </td>
            </tr>
            <tr align="left">
                <td>
                    <small class="text-bold">
                        Payslip Number
                    </small>
                </td>
                <td>
                    00{{ $payslip->id }}
                </td>
            </tr>
            <tr align="left">
                <td>
                    <small class="text-bold">
                        Payroll Date
                    </small>
                </td>
                <td>
                    {{ $payslip->payroll['created_at'] }}
                </td>
            </tr>
            <tr align="left">
                <td>
                    <small class="text-bold">
                        Period
                    </small>
                </td>
                <td>
                    {{ $payslip->period['slug'] }}
                </td>
            </tr>

        </table>
    </div>
</div>
<h5>
    Earnings Calculations
</h5>
