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

use App\Models\Voter;
use App\Models\Poll;
use Cabrbon\Carbon;


class ExportVoterReport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromQuery, ShouldQueue, WithMapping, WithHeadings, WithProperties, ShouldAutoSize, WithStyles, WithCustomValueBinder
{

    use Exportable;

    public function __construct($filter_array, $start_id = null, $end_id = null)
    {
        $this->poll_id         =  $filter_array['poll_id'];
        $this->search          =  $filter_array['search'];
        $this->created_from    =  $filter_array['created_from'];
        $this->created_to      =  $filter_array['created_to'];
        $this->poll            =  Poll::find($this->poll_id);
        $this->start_id        =  $start_id;
        $this->end_id          =  $end_id;
    }

    public function headings(): array
    {
        return [
            'BROWSER',
            'IP ADDRESS',
            'COUNTRY',
            'CITY',
            'DEVICE',
            'PLATFORM',
            'REFERER',
            'LAST VOTED FOR',
            'CREATED AT',
        ];
    }

    public function query()
    {

        $query = Voter::whereBetween('id', [$this->start_id, $this->end_id])
        ->orderBy('created_at','DESC');

        $query->whereHas('votes', function($q){
            $q->where('poll_id', $this->poll_id);
        });

        $query->orWhere('ip_address','like','%'.$this->search.'%')
        ->orWhere('browser','like','%'.$this->search.'%')
        ->orWhere('country','like','%'.$this->search.'%')
        ->orWhere('city','like','%'.$this->search.'%')
        ->orWhere('user_agent','like','%'.$this->search.'%')
        ->orWhere('device','like','%'.$this->search.'%')
        ->orWhere('platform','like','%'.$this->search.'%');

        return $query;

    }

    /**
    * @param Voter $voter
    */
    public function map($voter): array
    {
        return [
            $voter->browser ?? 'N/A',
            $voter->ip_address ?? 'N/A',
            $voter->country ?? 'N/A',
            $voter->city ?? 'N/A',
            $voter->device ?? 'N/A',
            $voter->platform ?? 'N/A',
            $voter->referer ?? 'N/A',
            $voter->lastVotedFor(),
            $voter->created_at,
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
            'title'          => 'Voter Report',
            'description'    => 'Voter Report for ' . ($this->poll ? $this->poll->title : 'All Polls'),
            'subject'        => 'Voter Report',
            'keywords'       => 'patrol,export,spreadsheet',
            'category'       => 'Voter Report',
            'manager'        => '+254 799 147 582',
            'company'        => 'ShieldMaster Africa',
        ];
    }

}
