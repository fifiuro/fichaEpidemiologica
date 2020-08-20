<?php

namespace App\Exports;

use App\Diagnostico;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DiagnosticoExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    public function headings(): array
    {
        return [
            'ID',
            'Diagnostico',
            'Estado',
            'Fecha1',
            'Fecha2'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $celRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($celRange)->getFont()->setSize(20);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Diagnostico::all();
    }

    /**
     * PAGINAS INTERESANTES
     * https://laraveldaily.com/laravel-excel-export-formatting-and-styling-cells/
     * https://styde.net/exportar-archivos-en-formato-excel-con-laravel-excel-3-x/
     * https://docs.laravel-excel.com/2.1/blade/styling.html
     */
}
