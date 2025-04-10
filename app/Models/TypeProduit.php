<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TypeProduit extends Model
{
    use HasFactory;

    // Définir la table assocéèe
    protected $table = 'type_produits';

    // définir les colones
    protected $fillable = ['nom'];

    // relation avec la table produits

    public function produits()
    {
        return $this->hasMany(Produit::class,'type_produit_id');
    }
}
