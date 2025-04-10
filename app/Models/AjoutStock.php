<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoutStock extends Model
{
    use HasFactory;

    protected $table = 'ajout_stocks';

    protected $fillable = [
        'produit_id',
        'quantite_ajoutee',
        'lieu_stockage',
        'date_ajout',
    ];

    protected $casts = [
        'date_ajout' => 'datetime',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
