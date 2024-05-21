<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class PeminjamanExport implements FromQuery
{
  
    use Exportable;

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return DataModel::query()
            ->whereBetween('date_field', [$this->startDate, $this->endDate]); // Adjust field names and table names as necessary
    }

}
