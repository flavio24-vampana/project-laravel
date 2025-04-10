<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="container mt-4">
    <h1 class="mb-4">Détail du Type de Produit</h1>

    <div class="mb-3">
        <strong>Nom : </strong> {{ $typeProduit->nom }}
    </div>

    <a href="{{ route('typeproduits.index') }}" class="btn btn-secondary">Retour</a>
</body>
</html>
