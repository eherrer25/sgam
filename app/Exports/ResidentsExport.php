<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResidentsExport implements FromView
{
    protected $residents;
    protected $month;

    public function __construct($residents,$month)
    {
        $this->residents = $residents;
        $this->month = $month;
    }

    public function view(): View
    {
        return view('exports.residents', [
            'residents' => $this->residents,
            'month' => $this->month
        ]);
    }

}
