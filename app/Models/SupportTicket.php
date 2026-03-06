<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
        'priority',
    ];

    // Constantes de estado
    const STATUS_ABIERTO = 'abierto';
    const STATUS_EN_PROGRESO = 'en_progreso';
    const STATUS_CERRADO = 'cerrado';

    // Constantes de prioridad
    const PRIORITY_BAJA = 'baja';
    const PRIORITY_MEDIA = 'media';
    const PRIORITY_ALTA = 'alta';

    /**
     * Obtener los estados disponibles.
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_ABIERTO => 'Abierto',
            self::STATUS_EN_PROGRESO => 'En Progreso',
            self::STATUS_CERRADO => 'Cerrado',
        ];
    }

    /**
     * Obtener las prioridades disponibles.
     */
    public static function priorities(): array
    {
        return [
            self::PRIORITY_BAJA => 'Baja',
            self::PRIORITY_MEDIA => 'Media',
            self::PRIORITY_ALTA => 'Alta',
        ];
    }

    /**
     * Relación: el ticket pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
