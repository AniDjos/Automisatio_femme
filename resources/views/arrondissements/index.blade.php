@extends('welcome')

@section('name', 'Liste des Arrondissements')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Arrondissements</h1>

    <!-- Bouton pour ajouter un nouvel arrondissement -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('arrondissements.create') }}" class="btn-create">
            <i class='bx bx-plus'></i> Ajouter un Arrondissement
        </a>
    </div>

    <!-- Tableau des arrondissements -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Commune</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arrondissements as $arrondissement)
                <tr>
                    <td>{{ $arrondissement->arrondissement_id }}</td>
                    <td>{{ $arrondissement->arrondissement_libelle }}</td>
                    <td>{{ $arrondissement->commune->commune_libelle ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('arrondissements.edit', $arrondissement->arrondissement_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class='bx bx-edit'></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('arrondissements.destroy', $arrondissement->arrondissement_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet arrondissement ?')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun arrondissement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $arrondissements->links() }}
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
    background-color: #9b87f5;
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