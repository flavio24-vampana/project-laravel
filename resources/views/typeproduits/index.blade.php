<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Type de produits</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4" >
    <h1 class="mb-4">Liste des types de produits</h1>
    <a href="{{ route('typeproduits.create') }}" class="btn btn-primary mb-3">Ajouter</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td> {{ $type->nom }} </td>
                <td>
                    <a href="{{ route('typeproduits.edit', $type->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('typeproduits.destroy', $type->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('voulez-vous supprimer définitivement ?')" >Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
