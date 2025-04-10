<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    // définir la table associée
    protected $table = 'produits';

    // définir les colonnes
    protected $fillable = ['nom','quantite_recoltee','date_recolte','statut','type_produit_id'];

    // relation avec la table type_produit

    public function typeproduit()
    {
        return $this->belongsTo(TypeProduit::class,'type_produit_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function ajouts()
    {
        return $this->hasMany(AjoutStock::class);
    }


}
