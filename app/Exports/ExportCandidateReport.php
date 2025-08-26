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

use App\Models\Candidate;
use App\Models\Poll;
use Carbon\Carbon;


class ExportCandidateReport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromQuery, ShouldQueue, WithMapping, WithHeadings, WithProperties, ShouldAutoSize, WithStyles, WithCustomValueBinder
{

    use Exportable;

    public $timeout = 3300;

    public function __construct($filter_array)
    {
        $this->poll_id      =   $filter_array['poll_id'];
        $this->search       =   $filter_array['search'];
    }

    public function headings(): array
    {
        return [
            'TITLE',
            'NAME',
            'VOTES',
            'PERCENTAGE %',
        ];
    }

    public function query()
    {
        return Candidate::query()
        ->where('poll_id', $this->poll_id)
        ->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%');
        })->orderBy('name', 'ASC');
    }

    /**
    * @param Candidate $candidate
    */
    public function map($candidate): array
    {

        return [
            $candidate->title,
            $candidate->name,
            number_format($candidate->vote_count),
            number_format($candidate->vote_percentage,2),
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
            'title'          => 'Candidates Report',
            'description'    => 'Candidates Report',
            'subject'        => 'Candidates Report',
            'keywords'       => 'patrol,export,spreadsheet',
            'category'       => 'Candidates Report',
            'manager'        => '+254 799 147 582',
            'company'        => 'ShieldMaster Africa',
        ];
    }

}
