@extends('welcome')

@section('name', 'Liste des Filières')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Filières</h1>

    <!-- Bouton pour créer une nouvelle filière -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('filiere.create') }}" class="btn-create">
            <i class='bx bx-plus'></i> Ajouter une Filière
        </a>
    </div>

    <!-- Tableau des filières -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filieres as $filiere)
                <tr>
                    <td>{{ $filiere->filiere_id }}</td>
                    <td>{{ $filiere->filiere_nom }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('filiere.edit', $filiere->filiere_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class='bx bx-edit'></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('filiere.destroy', $filiere->filiere_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucune filière trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $filieres->links() }}
    </div>
</div>

<style>
.containerer {
    width: 1200px;
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
    background-color:  #9b87f5;
}

.btn-edit:hover {
    background-color:  #9b87f5;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>
@endsection