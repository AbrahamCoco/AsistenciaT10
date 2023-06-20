<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoraRegis extends Model
{
    protected $table = 'horas_registradas';

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'horas_transcurridas',
        'user_id',
        'tipo_id',
    ];

    protected $dates = ['hora_inicio', 'hora_fin'];

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

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id', 'id');
        return $this->belongsTo('App\Tipo');
    }
}
