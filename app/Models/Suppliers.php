<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'name',
        'cpf_cnpj',
        'telefone'
        
    ];

    /**
     * Get the type associated with the supplier.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
