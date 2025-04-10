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
    <h1 class="mb-4">Stocks</h1>
    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Ajouter</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité en stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td> {{ $stock->produit->nom }} </td>
                <td>{{ $stock->quantite_en_stock }} </td>
                <td>
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{route('stocks.destroy', $stock->id)}}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez vous supprimer ce stock ?')" >Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        <h2>Historique des ajouts de stock</h2>
        @forelse($stocks as $stock)
            @foreach($stock->produit->ajouts as $ajout)
                <div class="card my-2">
                    <div class="card-body">
                        <strong>Produit :</strong> {{ $stock->produit->nom }}
                        <strong>Quantité ajoutée :</strong> +{{ $ajout->quantite_ajoutee }}
                        <strong>Lieu de stockage :</strong> {{ $ajout->lieu_stockage }}
                        <strong>Date d'ajout :</strong> {{ $ajout->date_ajout->format('d/m/Y H:i') }}
                    </div>
                </div>
            @endforeach
        @empty
            <p>Aucun ajout de stock trouvé.</p>
        @endforelse
    </div>


</body>
</html>
