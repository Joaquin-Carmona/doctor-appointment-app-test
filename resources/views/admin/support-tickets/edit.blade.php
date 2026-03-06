<x-admin-layout
    title="Editar Ticket | MediMatch"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Tickets de Soporte', 'href' => route('admin.support-tickets.index')],
        ['name' => 'Editar'],
    ]"
>
    {{-- Header Card --}}
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8 mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 text-purple-600">
                    <i class="fa-solid fa-headset text-3xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $supportTicket->subject }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Creado por: {{ $supportTicket->user->name }}</p>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2">
                        <span class="text-xs text-gray-500">
                            <span class="font-medium">Fecha:</span>
                            {{ $supportTicket->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.support-tickets.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver
                </a>
                <button type="submit" form="edit-ticket-form"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    <i class="fa-solid fa-check"></i>
                    Guardar cambios
                </button>
            </div>
        </div>
    </div>

    {{-- Formulario principal --}}
    <form id="edit-ticket-form" action="{{ route('admin.support-tickets.update', $supportTicket) }}" method="POST">
        @csrf
        @method('PUT')

        <x-wire-card>
            <div class="grid lg:grid-cols-2 gap-4">
                <x-wire-input
                    label="Asunto"
                    name="subject"
                    placeholder="Asunto del ticket"
                    value="{{ old('subject', $supportTicket->subject) }}"
                    class="lg:col-span-2"
                />

                <div class="space-y-1">
                    <x-wire-native-select
                        label="Estado"
                        name="status"
                        :options="$statuses"
                        option-key-value
                        placeholder="Seleccione un estado"
                        :value="old('status', $supportTicket->status)"
                    />
                </div>

                <div class="space-y-1">
                    <x-wire-native-select
                        label="Prioridad"
                        name="priority"
                        :options="$priorities"
                        option-key-value
                        placeholder="Seleccione una prioridad"
                        :value="old('priority', $supportTicket->priority)"
                    />
                </div>

                <x-wire-textarea
                    label="Descripción"
                    name="description"
                    placeholder="Describa el problema o solicitud"
                    class="lg:col-span-2"
                    :value="old('description', $supportTicket->description)"
                />
            </div>
        </x-wire-card>
    </form>

</x-admin-layout>
