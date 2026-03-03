<x-admin-layout
    title="Nuevo Ticket | MediMatch"
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
            'name' => 'Nuevo',
        ],
    ]"
>
    <x-wire-card>
        <form action="{{ route('admin.support-tickets.store') }}" method="POST">
            @csrf

            <div class="grid lg:grid-cols-2 gap-4">
                <x-wire-input label="Asunto" name="subject" placeholder="Asunto del ticket"
                    value="{{ old('subject') }}" class="lg:col-span-2">
                </x-wire-input>

                <div class="space-y-1 lg:col-span-2 lg:w-1/2">
                    <x-wire-native-select label="Prioridad" name="priority"
                        :options="$priorities"
                        option-key-value
                        placeholder="Seleccione una prioridad"
                        :value="old('priority', 'media')">
                    </x-wire-native-select>
                </div>

                <x-wire-textarea label="Descripción" name="description"
                    placeholder="Describa su problema o solicitud con detalle"
                    class="lg:col-span-2"
                    :value="old('description')">
                </x-wire-textarea>
            </div>

            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>Crear Ticket</x-wire-button>
            </div>

        </form>
    </x-wire-card>

    <div class="flex justify-end mt-4">
        <x-wire-button flat secondary href="{{ route('admin.support-tickets.index') }}">
            Volver a la lista de tickets
        </x-wire-button>
    </div>

</x-admin-layout>
