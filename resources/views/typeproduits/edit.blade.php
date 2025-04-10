<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier un type</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Modifier un type de produit</h1>

    <form action="{{ route('typeproduits.update', ['typeproduit' => $typeproduit->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $typeproduit->nom }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="{{ route('typeproduits.index') }}" class="btn btn-secondary">Retour</a>
    </form>

</body>
</html>
