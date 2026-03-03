<x-admin-layout
    title="Tickets de Soporte | MediMatch"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Tickets de Soporte',
        ],
    ]"
>

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.support-tickets.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    @livewire('admin.data-tables.support-ticket-table')

</x-admin-layout>
