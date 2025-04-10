<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'produit_id', 'type', 'date_transaction', 'quantite', 'prix_unitaire','prix_total', 'beneficiaire','client'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::Class);
    }
}
