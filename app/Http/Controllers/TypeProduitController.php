<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeProduit;

class TypeProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = TypeProduit::all();
        return view('typeproduits.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('typeproduits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:type_produits',
        ]);
        TypeProduit::create($request->all());

        return \redirect()->route('typeproduits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeProduit $typeProduit)
    {
        return view('typeproduits.show', compact('typeProduit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeProduit $typeproduit)
    {
        return view('typeproduits.edit', compact('typeproduit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeProduit $typeproduit)
    {
        $request->validate([
            'nom' => 'required|string|unique:type_produits,nom,' . $typeproduit->id,
        ]);

        $typeproduit->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('typeproduits.index')->with('success', 'Type de produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeProduit = TypeProduit::findOrFail($id);
        $typeProduit->delete();
        return \redirect()->route('typeproduits.index')->with('success','Type de produit supprimé avec succès');
    }
}
