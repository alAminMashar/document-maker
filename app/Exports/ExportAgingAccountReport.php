<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;

use App\Models\AgedAccount;
use Cabrbon\Carbon;


class ExportAgingAccountReport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromQuery, ShouldQueue, WithMapping, WithHeadings, WithProperties, ShouldAutoSize, WithStyles, WithCustomValueBinder
{

    use Exportable;

    public $timeout = 3300;

    public function __construct($filter_array)
    {
        $this->search         =  $filter_array['search'];
        $this->period         =  $filter_array['period'];
        $this->balance_min    =  $filter_array['balance_min'];
        $this->balance_max    =  $filter_array['balance_max'];
    }

    public function headings(): array
    {

        $start_date = $this->period->agedAccounts()
            ->orderBy('start_date', 'ASC')
            ->first()
            ->start_date;

        return [
            'CUSTOMER',
            'TOTAL',
            $this->period['30DayRange'],
            $this->period['60DayRange'],
            $this->period['90DayRange'],
            $this->period['120DayRange'],
            'OVER 120 DAYS',
        ];
    }

    public function query()
    {
        $search     =  $this->search;
        $period     =  $this->period;
        $min        =  $this->balance_min;
        $max        =  $this->balance_max;

        $query = AgedAccount::query()
        ->where('financial_period_id', $period->id)
        ->orderBy('balance_due','DESC')
        ->with('customer');

        if($search != '') {
            $query->whereHas('customer',function($q) {
                $q->where('name','like','%'.$search.'%')
                ->orWhere('kra_pin','like','%'.$search.'%')
                ->orWhere('code','like','%'.$search.'%')
                ->orWhere('id','like','%'.$search.'%');
            });
        }


        if($min != 0) {
            $query->where('current_balance','>=',$min);
        }

        if($max != 0) {
            $query->where('current_balance','<=',$max);
        }

        return $query;

    }

    /**
    * @param AgedAccount $agedAccount
    */
    public function map($account): array
    {
        return [
            $account->customer->name,
            number_format($account['balance_due'], 2),
            number_format($account->current, 2),
            number_format($account['30_days'], 2),
            number_format($account['60_days'], 2),
            number_format($account['90_days'], 2),
            number_format($account['120_days'], 2),
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'bold' => true,
                    'size' =>  13,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => [
                        'argb' => 'fff060',
                    ],
                    'endColor' => [
                        'argb' => 'e7a300',
                    ],
                ],
            ],
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => 'A. Macharia',
            'title'          => 'Aged Receivables Report Report',
            'description'    => 'ShieldMaster Africa ERP - Automated Aged Receivables Report Processing',
            'subject'        => 'Aged Receivables Report',
            'keywords'       => 'patrol,export,spreadsheet',
            'category'       => 'Aged Receivables Report',
            'manager'        => '+254 799 147 582',
            'company'        => 'ShieldMaster Africa',
        ];
    }

}
