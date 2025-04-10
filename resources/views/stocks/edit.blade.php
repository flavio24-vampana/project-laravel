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
    <h1 class="mb-4">Modifier un stock</h1>
    <form action="{{route('stocks.update', $stock->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="produit_id" class="form-label">Produit</label>
        <select name="produit_id" id="produit_id" class="form-control" disabled>

            <option value="{{ $stock->produit->id }}"> {{ $stock->produit->nom }} </option>
        </select>

        <label for="quantite_en_stock" class="form-label">Quantite en stock</label>
        <input type="number" name="quantite_en_stock" class="form-control" value="{{ $stock->quantite_en_stock }}" required>

        <label for="lieu_stockage" class="form-label">Lieu de stockage :</label>
        <input type="text" name="lieu_stockage" class="form-control" value="{{ $stock->lieu_stockage }}" required>

        <button type="submit" class="btn btn-success">Mettre à jour</button>

    </form>

</body>
</html>
