<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Ajouter un stock</h1>
    <form action="{{route('stocks.store')}}" method="POST">
        @csrf
        <label for="produit_id" class="form-label">Produit</label>
        <select name="produit_id" id="produit_id" class="form-control" required>
            @foreach($produits as $produit)
            <option value="{{ $produit->id }}"> {{ $produit->nom }} </option>
            @endforeach
        </select>

        <label for="quantite_en_stock" class="form-label">Quantite en stock(En kg)</label>
        <input type="number" name="quantite_en_stock" class="form-control" required>

        <label for="lieu_stockage" class="form-label">Lieu de stockage :</label>
        <input type="text" name="lieu_stockage" class="form-control" required>

        <button type="submit" class="btn btn-success">Ajouter</button>

    </form>

</body>
</html>
