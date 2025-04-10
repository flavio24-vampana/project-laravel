<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier un produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Modifier un produit</h1>
    <form action="{{ route('produits.update', ['produit'=>$produit->id]) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $produit->nom }}" required>
        </div>
        <div class="mb-3">
            <label for="quantite_recoltee" class="form-label">Quantite recoltée</label>
            <input type="number" class="form-control" id="quantite_recoltee" name="quantite_recoltee" value="{{ $produit->quantite_recoltee }}" required>
        </div>
        <div class="mb-3">
            <label for="date_recolte" class="form-label">Date de récolte</label>
            <input type="date" class="form-control" id="date_recolte" name="date_recolte" value="{{ $produit->date_recolte }}" required>
        </div>
        {{-- <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="stocke" {{ old('statut', $produit->statut) == 'stocke' ? 'selected': '' }} >Stocké</option>
                <option value="vendu" {{ old('statut', $produit->statut) == 'vendu' ? 'selected': '' }} >Vendu</option>
                <option value="distribue" {{ old('statut', $produit->statut) == 'Distribue' ? 'selected': '' }} >Distribué</option>
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="type_produit_id" class="form-label">Type de produit</label>
            <select name="type_produit_id" id="type_produit_id" class="form-control"  required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_produit_id', $produit->type_produit_id) == $type->id ? 'selected':'' }} > {{ $type->nom }} </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour</a>

    </form>

</body>
</html>
