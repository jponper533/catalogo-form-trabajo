<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class DynamicExport implements FromArray, WithHeadings
{
    protected $data;
    protected $columns;

    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function array(): array
    {
        // Convertimos cada fila al orden de columnas
        return $this->data->map(function ($item) {
            return (array) $item;
        })->toArray();
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
