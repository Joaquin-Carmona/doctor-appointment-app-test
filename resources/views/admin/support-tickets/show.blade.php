<x-admin-layout
    title="Detalle Ticket | MediMatch"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Tickets de Soporte',
            'href' => route('admin.support-tickets.index'),
        ],
        [
            'name' => $supportTicket->subject,
        ],
    ]"
>
    <x-wire-card>
        <div class="grid lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Ticket</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Asunto</dt>
                        <dd class="text-sm text-gray-900">{{ $supportTicket->subject }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Estado</dt>
                        <dd class="text-sm">
                            @php
                                $statusColors = [
                                    'abierto' => 'bg-green-100 text-green-800',
                                    'en_progreso' => 'bg-yellow-100 text-yellow-800',
                                    'cerrado' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'abierto' => 'Abierto',
                                    'en_progreso' => 'En Progreso',
                                    'cerrado' => 'Cerrado',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$supportTicket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusLabels[$supportTicket->status] ?? $supportTicket->status }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Prioridad</dt>
                        <dd class="text-sm">
                            @php
                                $priorityColors = [
                                    'baja' => 'bg-blue-100 text-blue-800',
                                    'media' => 'bg-orange-100 text-orange-800',
                                    'alta' => 'bg-red-100 text-red-800',
                                ];
                                $priorityLabels = [
                                    'baja' => 'Baja',
                                    'media' => 'Media',
                                    'alta' => 'Alta',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $priorityColors[$supportTicket->priority] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $priorityLabels[$supportTicket->priority] ?? $supportTicket->priority }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Usuario</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Creado por</dt>
                        <dd class="text-sm text-gray-900">{{ $supportTicket->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-sm text-gray-900">{{ $supportTicket->user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Fecha de creación</dt>
                        <dd class="text-sm text-gray-900">{{ $supportTicket->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                        <dd class="text-sm text-gray-900">{{ $supportTicket->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h3>
                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $supportTicket->description }}</p>
            </div>
        </div>
    </x-wire-card>

    <div class="flex justify-end mt-4 space-x-2">
        <x-wire-button flat secondary href="{{ route('admin.support-tickets.index') }}">
            Volver
        </x-wire-button>
        <x-wire-button blue href="{{ route('admin.support-tickets.edit', $supportTicket) }}">
            <i class="fa-solid fa-pen-to-square"></i>
            Editar
        </x-wire-button>
    </div>

</x-admin-layout>
