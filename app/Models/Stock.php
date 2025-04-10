<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['produit_id', 'quantite_en_stock', 'lieu_stockage'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    
    public static function ajouterStock($produitId, $quantite)
    {
        $stock = Stock::where('produit_id', $produitId)->first();

        if ($stock) {
            // Si le stock existe déjà, on l'augmente
            $stock->quantite_en_stock += $quantite;
            $stock->save();
        } else {
            // Si le stock n'existe pas, on le crée
            Stock::create([
                'produit_id' => $produitId,
                'quantite_en_stock' => $quantite,
                'lieu_stockage' => 'Non défini', // Valeur par défaut, à modifier si nécessaire
            ]);
        }
    }
}
