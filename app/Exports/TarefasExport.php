<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return auth()->user()->tarefas()->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'Tarefa',
            'Data limite conclusão',
        ];
    }

    public function map($tarefa): array
    {
        return [
            $tarefa->id,
            $tarefa->tarefa,
            date('d/m/Y', strtotime($tarefa->data_conclusao))
        ];
    }
}
