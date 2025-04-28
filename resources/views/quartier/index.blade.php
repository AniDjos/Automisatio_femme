@extends('welcome')

@section('name', 'Liste des Quartiers')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Quartiers</h1>

    <!-- Bouton pour créer un nouveau quartier -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('quartier.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Ajouter un Quartier
        </a>
    </div>

    <!-- Tableau des quartiers -->
    <table class="table">
        <thead>
            <tr>
                <th>Nom du Quartier</th>
                <th>Arrondissement</th>
                <th>Commune</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($quartiers as $quartier)
                <tr>
                    <td>{{ $quartier->quartier_libelle }}</td>
                    <td>{{ $quartier->arrondissement->arrondissement_libelle }}</td>
                    <td>{{ $quartier->arrondissement->commune->commune_libelle }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('quartier.edit', $quartier->quartier_id) }}" class="btn-action btn-edit">
                            <i class="bx bx-edit"></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('quartier.destroy', $quartier->quartier_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun quartier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $quartiers->links() }}
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

.btn-create {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-create:hover {
    background-color: #7a6ad8;
}

.btn-action {
    padding: 0.5rem 1rem;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-edit {
    background-color: #9b87f5;
    color: white;
    text-decoration: none;
}

.btn-edit:hover {
    background-color: #9b87f5;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
}

.btn-delete:hover {
    background-color: #c82333;
}

.pagination-container {
    text-align: center;
}
</style>
@endsection