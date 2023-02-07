<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoraRegis extends Model
{
    protected $table = 'horas_registradas';

    protected $fillable = [
        'user_id',
        'hora_inicio',
        'hora_fin',
        'horas_transcurridas',
    ];

    /**
     * Get the user that owns the Hora
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo('App\User');
    }
}
