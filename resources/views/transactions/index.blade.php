<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4">
        Historique des transactions
    </h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Nouvelle Transaction</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>prix unitaire</th>
                <th>prix total</th>
                <th>client/bénéficiaire</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->produit->nom }}</td>
                <td>{{ ucfirst($transaction->type) }}</td>
                <td>{{ $transaction->quantite }}</td>
                <td>{{ $transaction->prix_unitaire ?? '-' }}</td>
                <td>{{ $transaction->prix_total ?? '-' }}</td>
                <td>{{ $transaction->client ?? $transaction->beneficiaire }}</td>
                <td>{{ $transaction->date_transaction }}</td>
                <td>
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette transaction ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
