@extends('welcome')

@section('name', 'Liste des Communes')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Communes</h1>

    <!-- Bouton pour ajouter une nouvelle commune -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('communes.create') }}" class="btn-create">
            <i class='bx bx-plus'></i> Ajouter une Commune
        </a>
    </div>

    <!-- Tableau des communes -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Département</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($communes as $commune)
                <tr>
                    <td>{{ $commune->commune_id }}</td>
                    <td>{{ $commune->commune_libelle }}</td>
                    <td>{{ $commune->departement->departement_libelle ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('communes.edit', $commune->commune_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class='bx bx-edit'></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('communes.destroy', $commune->commune_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commune ?')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune commune trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $communes->links() }}
    </div>
</div>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 2rem 2rem 17rem;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #9b87f5;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 0.8rem;
    text-align: left;
}

.table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.btn-create, .btn-edit, .btn-delete {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-create {
    background-color: #9b87f5;
}

.btn-create:hover {
    background-color: #7a6ad8;
}

.btn-edit {
    background-color: #9b87f5;
}

.btn-edit:hover {
    background-color: #9b87f5;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>
@endsection