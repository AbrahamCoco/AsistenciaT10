<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo';

    protected $fillable = [
        'user_id',
        'tipo',
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
