<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50" align="left">Employee Information</th>
            <th class="w-50" align="left">Payslip Information</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <P>
                        <small class="text-bold">
                            Name
                        </small>
                        {{ $payslip->employee->name() }}
                    </P>
                    <P>
                        <small class="text-bold">
                            National ID
                        </small>
                        {{ $payslip->employee['id_number'] }}
                    </P>
                    <P>
                        <small class="text-bold">
                            Phone Number
                        </small>
                        {{ $payslip->employee['phone'] }}
                    </P>
                    <P>
                        <small class="text-bold">
                            KRA PIN
                        </small>
                        {{ $payslip->employee['kra_pin'] }}
                    </P>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <P>
                        <small class="text-bold">
                            Payroll Number
                        </small>
                        00{{ $payslip->payroll['id'] }}
                    </P>
                    <P>
                        <small class="text-bold">
                            Payslip Number
                        </small>
                        00{{ $payslip->id }}
                    </P>
                    <P>
                        <small class="text-bold">
                            Payroll Date
                        </small>
                        {{ $payslip->payroll['created_at'] }}
                    </P>
                    <P>
                        <small class="text-bold">
                            Period
                        </small>
                        {{ $payslip->period['slug'] }}
                    </P>
                </div>
            </td>
        </tr>
    </table>
</div>
