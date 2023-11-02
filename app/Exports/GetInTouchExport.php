<?php

namespace App\Exports;

use App\Models\GetInTouch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GetInTouchExport implements FromCollection, WithHeadings, WithStyles

{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Query the GetInTouch model with the date range filter
        $query = GetInTouch::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);

        // Fetch the results and return as a collection
        $results = $query->get(['name','company_name','contact_number','email','message','created_at']);

        // Transform the results into a collection
        return new Collection($results);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        // Replace these headings with your desired field titles
        return [
            'Name',
            'Company Name',
            'Contact Number',
            'Email',
            'Message',
            'Date',
        ];
    }
}
