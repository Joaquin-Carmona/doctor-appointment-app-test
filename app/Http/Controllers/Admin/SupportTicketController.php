<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * Mostrar la lista de tickets de soporte.
     */
    public function index()
    {
        return view('admin.support-tickets.index');
    }

    /**
     * Mostrar el formulario para crear un nuevo ticket.
     */
    public function create()
    {
        $priorities = SupportTicket::priorities();
        return view('admin.support-tickets.create', compact('priorities'));
    }

    /**
     * Almacenar un nuevo ticket de soporte.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject'     => 'required|string|max:255',
            'description' => 'required|string|min:10|max:5000',
            'priority'    => 'required|in:baja,media,alta',
        ]);

        SupportTicket::create([
            'user_id'     => auth()->id(),
            'subject'     => $validated['subject'],
            'description' => $validated['description'],
            'priority'    => $validated['priority'],
            'status'      => 'abierto',
        ]);

        return redirect()->route('admin.support-tickets.index')
            ->with('swal', [
                'title' => 'Ticket creado',
                'text'  => 'El ticket de soporte ha sido creado exitosamente.',
                'icon'  => 'success',
            ]);
    }

    /**
     * Mostrar el detalle de un ticket de soporte.
     */
    public function show(SupportTicket $supportTicket)
    {
        $supportTicket->load('user');
        return view('admin.support-tickets.show', compact('supportTicket'));
    }

    /**
     * Mostrar el formulario para editar un ticket de soporte.
     */
    public function edit(SupportTicket $supportTicket)
    {
        $supportTicket->load('user');
        $statuses = SupportTicket::statuses();
        $priorities = SupportTicket::priorities();
        return view('admin.support-tickets.edit', compact('supportTicket', 'statuses', 'priorities'));
    }

    /**
     * Actualizar un ticket de soporte.
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        $validated = $request->validate([
            'subject'     => 'required|string|max:255',
            'description' => 'required|string|min:10|max:5000',
            'status'      => 'required|in:abierto,en_progreso,cerrado',
            'priority'    => 'required|in:baja,media,alta',
        ]);

        $supportTicket->update($validated);

        return redirect()->route('admin.support-tickets.edit', $supportTicket)
            ->with('swal', [
                'title' => 'Ticket actualizado',
                'text'  => 'El ticket de soporte ha sido actualizado exitosamente.',
                'icon'  => 'success',
            ]);
    }

    /**
     * Eliminar un ticket de soporte.
     */
    public function destroy(SupportTicket $supportTicket)
    {
        $supportTicket->delete();

        return redirect()->route('admin.support-tickets.index')
            ->with('swal', [
                'title' => 'Ticket eliminado',
                'text'  => 'El ticket de soporte ha sido eliminado exitosamente.',
                'icon'  => 'success',
            ]);
    }
}
