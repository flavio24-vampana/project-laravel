<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('produit')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
        return view('transactions.create',compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id'=> 'required|exists:produits,id',
            'type'=>'required|in:vente,distribution',
            'quantite'=>'required|numeric|min:1',
            'prix_unitaire'=>'nullable|numeric|min:0',
            'client' => 'nullable|string|max:255',
            'beneficiaire' => 'nullable|string|max:255',
            'date_transaction' => 'required|date',
        ]);

        $stock = Stock::where('produit_id', $validated['produit_id'])->first();

        if (!$stock || $stock->quantite_en_stock < $validated['quantite']) {
            return back()->withErrors(['quantite' => 'Stock insuffisant']);
        }

        $stock->quantite_en_stock -= $validated['quantite'];
        $stock->save();

        $validated['prix_total'] = $validated['type'] === 'vente'
            ? $validated['quantite'] * $validated['prix_unitaire']
            : null;

        $transaction = Transaction::create($validated);

        $produit = Produit::find($validated['produit_id']);
        $produit->statut = $validated['type'] === 'vente' ? 'vendu' : 'distribue';
        $produit->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès');

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
        $transaction = Transaction::findOrFail($id);
        $produits = Produit::all();
        return view('transactions.edit',compact('produits','transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'produit_id'=> 'required|exists:produits,id',
            'type'=>'required|in:vente,distribution',
            'quantite'=>'required|numeric|min:1',
            'prix_unitaire'=>'nullable|numeric|min:0',
            'client' => 'nullable|string|max:255',
            'beneficiaire' => 'nullable|string|max:255',
            'date_transaction' => 'required|date',
        ]);
        $stock = Stock::where('produit_id', $transaction->produit_id)->first();
        $stock->quantite_en_stock += $transaction->quantite; // rollback ancienne quantité
        $stock->save();

        $newStock = Stock::where('produit_id', $validated['produit_id'])->first();
        if ($newStock->quantite_en_stock < $validated['quantite']) {
            return back()->withErrors(['quantite' => 'Stock insuffisant pour la mise à jour']);
        }

        $newStock->quantite_en_stock -= $validated['quantite'];
        $newStock->save();

        $validated['prix_total'] = $validated['type'] === 'vente'
            ? $validated['quantite'] * $validated['prix_unitaire']
            : null;

        $transaction->update($validated);

        $produit = Produit::find($validated['produit_id']);
        $produit->statut = $validated['type'] === 'vente' ? 'vendu' : 'distribue';
        $produit->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction mise à jour');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);$transaction = Transaction::findOrFail($id);

        $stock = Stock::where('produit_id', $transaction->produit_id)->first();
        $stock->quantite_en_stock += $transaction->quantite;
        $stock->save();

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success','Transaction supprimée');
    }
}
