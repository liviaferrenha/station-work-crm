<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'source',
        'probability',
        'expected_revenue',
        'company_name',
        'company_address',
        'job_title',
        'notes',
        'vendedor_id'
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
}