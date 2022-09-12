<?php

namespace Modules\Report\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Item\Dao\Models\Shift;
use Modules\Item\Dao\Repositories\GajiRepository;
use Modules\Item\Dao\Repositories\ShiftRepository;
use Modules\Procurement\Dao\Models\Stock;
use Modules\Procurement\Dao\Repositories\StockRepository;
use Modules\Report\Dao\Interfaces\GenerateReport;

class ReportGajiDetail extends GajiRepository implements FromView, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, GenerateReport
{
    public $name;

    public function generate($name)
    {
        $this->name = $name;
        return $this;
    }

    public function data()
    {
        $query = Shift::with(['has_jadwal', 'has_jadwal.has_user']);

        if ($from = request()->get('from')) {
            $query->where('shift_start', '>=', $from);
        }

        if ($to = request()->get('to')) {
            $query->where('shift_end', '<=', $to);
        }

        return $query->get();
    }

    public function view(): View
    {
        return view('Report::page.' . config('page') . '.' . $this->name, [
            'preview' => $this->data()
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 30,
            'D' => 30,
            'E' => 20,
            'F' => 10,
            'G' => 15,
            'H' => 20,
        ];
    }
}