<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\AjoutStock;
use App\Models\Produit;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with(['produit', 'produit.ajouts'])->get();
        return view('stocks.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
        return view('stocks.create',compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit_id'=>'required|exists:produits,id',
            'quantite_en_stock'=>'required|numeric|min:0',
            'lieu_stockage'=>'required|string|max:255',

        ]);
        $stock = Stock::where('produit_id', $request->produit_id)->first();

        if ($stock) {
            $stock->quantite_en_stock += $request->quantite_en_stock;
            $stock->lieu_stockage = $request->lieu_stockage; // Met à jour le lieu de stockage
            $stock->save(); // Sauvegarde le stock mis à jour
        } else {
            Stock::create([
                'produit_id' => $request->produit_id,
                'quantite_en_stock' => $request->quantite_en_stock,
                'lieu_stockage' => $request->lieu_stockage,
            ]);
        }

        AjoutStock::create([
            'produit_id' => $request->produit_id,
            'quantite_ajoutee' => $request->quantite_en_stock,
            'lieu_stockage' => $request->lieu_stockage,
            'date_ajout' => now(),
        ]);

        return redirect()->route('stocks.index')->with('success','Stock ajouté avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stock = Stock::with('produit')->findOrFail($id); // Charger le produit associé au stock
        return view('stocks.edit', compact('stock'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'quantite_en_stock'=>'required|numeric|min:1',
            'lieu_stockage' => 'required|string|max:255',
        ]);

        $stock = Stock::findOrFail($id);

        // Mise à jour du lieu de stockage
        $stock->lieu_stockage = $request->input('lieu_stockage');
        $stock->quantite_en_stock = $request->input('quantite_en_stock');
        $stock->save();
        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé');
    }
}
