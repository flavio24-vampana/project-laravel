<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\TypeProduit;
use App\Models\Stock;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('typeproduit')->get();
        return view('produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypeProduit::all();
        return view('produits.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'nom'=>'required|string|max:255',
            'quantite_recoltee'=>'required|numeric|min:0',
            'date_recolte'=>'required|date',
            // 'statut'=>'required|in:stocke,vendu,distribue',
            'type_produit_id'=>'required|exists:type_produits,id'
        ]);



        $produit = Produit::create([
            'nom' => $validated['nom'],
            'quantite_recoltee' => $validated['quantite_recoltee'],
            'date_recolte' => $validated['date_recolte'],
            'statut' => 'stocke', 
            'type_produit_id' => $validated['type_produit_id'],
        ]);


        return redirect()->route('produits.index')->with('success','Produit ajouté avec succes');
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
    public function edit(Produit $produit)
    {
        $types = TypeProduit::all();
        return view('produits.edit',compact('produit','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $validated=$request->validate([
            'nom'=>'required|string|max:255',
            'quantite_recoltee'=>'required|numeric|min:0',
            'date_recolte'=>'required|date',
            'type_produit_id'=>'required|exists:type_produits,id'
        ]);

        $produit->update($validated);
        return redirect()->route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success','Type de produit supprimé avec succès');
    }
}
