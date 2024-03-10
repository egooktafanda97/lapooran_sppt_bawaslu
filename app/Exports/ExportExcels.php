<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportExcels implements FromCollection, WithHeadings, WithMapping
{
    public $data;
    public $head;
    public function __construct($data, $head)
    {
        $this->data = $data;
        $this->head = $head;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }
    public function headings(): array
    {
        return $this->head;
    }
    public function map($record): array
    {
        return collect(collect($this->data[0])->keys()->toArray())->map(function ($x) use ($record) {
            return $record->{$x} ?? $record[$x] ?? null;
        })->toArray();
    }
}
