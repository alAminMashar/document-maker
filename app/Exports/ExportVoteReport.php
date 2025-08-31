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

use App\Models\VoteReport;


class ExportVoteReport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromQuery, ShouldQueue, WithMapping, WithHeadings, WithProperties, ShouldAutoSize, WithStyles, WithCustomValueBinder
{

    use Exportable;

    public function __construct($poll_id)
    {
        $this->poll_id         =  $poll_id;
    }

    public function headings(): array
    {
        return [
            'CANDIDATE NAME',
            'LOCATION',
            'BROWSER',
            'PLATFORM',
            'DATE'
        ];
    }

    public function query()
    {

        return VoteReport::query()->where('poll_id', $this->poll_id);

    }

    /**
    * @param Voter $report
    */
    public function map($report): array
    {
        return [
            $report->candidate_name ?? 'N/A',
            $report->voter_location ?? 'N/A',
            $report->browser ?? 'N/A',
            $report->platform ?? 'N/A',
            $report->vote->created_at ?? 'N/A',
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
            'creator'        => 'Al Ameen Macharia',
            'title'          => 'Vote Report',
            'description'    => 'Vote Report',
            'subject'        => 'Vote Report',
            'keywords'       => 'export,spreadsheet',
            'category'       => 'Vote Report',
            'manager'        => '+254 799 147 582',
            'company'        => 'ShieldMaster Africa',
        ];
    }

}
