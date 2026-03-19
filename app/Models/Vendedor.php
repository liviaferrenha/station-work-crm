<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'name',
        'email',
        'queue_position',
        'active'
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}