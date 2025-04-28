@extends('welcome')

@section('name', 'Liste des Appuis')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Appuis</h1>

    <!-- Bouton pour ajouter un nouvel appui -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('appuis.create') }}" class="btn-create">
            <i class='bx bx-plus'></i> Ajouter un Appui
        </a>
    </div>

    <!-- Tableau des appuis -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type d'Appui</th>
                <th>Description</th>
                <th>Date</th>
                <th>Groupement</th>
                <th>Structure</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appuis as $appui)
                <tr>
                    <td>{{ $appui->appuis_id }}</td>
                    <td>{{ $appui->type_appuis }}</td>
                    <td>{{ $appui->description }}</td>
                    <td>{{ $appui->date_appuis }}</td>
                    <td>{{ $appui->groupement->nom ?? 'Non spécifié' }}</td>
                    <td>{{ $appui->structure->structure ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('appuis.edit', $appui->appuis_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class='bx bx-edit'></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('appuis.destroy', $appui->appuis_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet appui ?')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucun appui trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $appuis->links() }}
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