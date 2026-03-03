<?php

namespace App\Livewire\Admin\DataTables;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SupportTicketTable extends DataTableComponent
{
    protected $model = SupportTicket::class;

    public function builder(): Builder
    {
        return SupportTicket::query()->with('user');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Asunto', 'subject')
                ->sortable()
                ->searchable(),
            Column::make('Usuario', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('Estado', 'status')
                ->sortable()
                ->format(function ($value) {
                    $colors = [
                        'abierto'     => 'bg-green-100 text-green-800',
                        'en_progreso' => 'bg-yellow-100 text-yellow-800',
                        'cerrado'     => 'bg-red-100 text-red-800',
                    ];
                    $labels = [
                        'abierto'     => 'Abierto',
                        'en_progreso' => 'En Progreso',
                        'cerrado'     => 'Cerrado',
                    ];
                    $color = $colors[$value] ?? 'bg-gray-100 text-gray-800';
                    $label = $labels[$value] ?? $value;
                    return '<span class="px-2 py-1 text-xs font-semibold rounded-full ' . $color . '">' . $label . '</span>';
                })
                ->html(),
            Column::make('Prioridad', 'priority')
                ->sortable()
                ->format(function ($value) {
                    $colors = [
                        'baja'  => 'bg-blue-100 text-blue-800',
                        'media' => 'bg-orange-100 text-orange-800',
                        'alta'  => 'bg-red-100 text-red-800',
                    ];
                    $labels = [
                        'baja'  => 'Baja',
                        'media' => 'Media',
                        'alta'  => 'Alta',
                    ];
                    $color = $colors[$value] ?? 'bg-gray-100 text-gray-800';
                    $label = $labels[$value] ?? $value;
                    return '<span class="px-2 py-1 text-xs font-semibold rounded-full ' . $color . '">' . $label . '</span>';
                })
                ->html(),
            Column::make('Fecha', 'created_at')
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y H:i')),
            Column::make('Acciones')
                ->label(function ($row) {
                    return view('admin.support-tickets.actions', ['supportTicket' => $row]);
                }),
        ];
    }
}
