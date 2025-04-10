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

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit</label>
            <select name="produit_id" class="form-control" required>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" {{ (old('produit_id', $transaction->produit_id ?? '') == $produit->id) ? 'selected' : '' }}>
                        {{ $produit->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" class="form-control" required>
                <option value="vente" {{ (old('type', $transaction->type ?? '') == 'vente') ? 'selected' : '' }}>Vente</option>
                <option value="distribution" {{ (old('type', $transaction->type ?? '') == 'distribution') ? 'selected' : '' }}>Distribution</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité(en kg)</label>
            <input type="number" name="quantite" class="form-control" value="{{ old('quantite', $transaction->quantite ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="prix_unitaire" class="form-label">Prix unitaire en francs cfa (optionnel pour distribution)</label>
            <input type="number" step="0.01" name="prix_unitaire" class="form-control" value="{{ old('prix_unitaire', $transaction->prix_unitaire ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="client" class="form-label">Client (si vente)</label>
            <input type="text" name="client" class="form-control" value="{{ old('client', $transaction->client ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="beneficiaire" class="form-label">Bénéficiaire (si distribution)</label>
            <input type="text" name="beneficiaire" class="form-control" value="{{ old('beneficiaire', $transaction->beneficiaire ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="date_transaction" class="form-label">Date de transaction</label>
            <input type="date" name="date_transaction" class="form-control" value="{{ old('date_transaction', $transaction->date_transaction ?? '') }}" required>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>


    </form>

</body>
</html>
