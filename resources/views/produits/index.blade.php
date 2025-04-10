<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produits</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4" >
    <h1 class="mb-4">liste des produits</h1>
    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3 ">Ajouter</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité récoltée</th>
                <th>Date de récolte</th>
                <th>statut</th>
                <th>Type de produit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
            <tr>
                <td> {{ $produit->nom }} </td>
                <td> {{ $produit->quantite_recoltee }} </td>
                <td> {{ $produit->date_recolte }} </td>
                <td> {{ $produit->statut }} </td>
                <td> {{ $produit->typeproduit->nom ?? 'N/A' }} </td>
                <td>
                    <a href="{{ route('produits.edit',$produit->id )}}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('produits.destroy', $produit->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('voulez-vous supprimer définitivement ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
