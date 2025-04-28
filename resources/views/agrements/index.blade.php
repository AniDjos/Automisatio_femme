@extends('welcome')

@section('name', 'Liste des Agréments')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Agréments</h1>

    <!-- Bouton pour créer un nouvel agrément -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('agrement.create') }}" class="btn-create">
            <i class='bx bx-plus'></i> Ajouter un Agrément
        </a>
    </div>

    <!-- Tableau des agréments -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Structure</th>
                <th>Référence</th>
                <th>Document</th>
                <th>Date de Livraison</th>
                <th>Groupement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agrements as $agrement)
                <tr>
                    <td>{{ $agrement->agrement_id }}</td>
                    <td>{{ $agrement->structure }}</td>
                    <td>{{ $agrement->reference }}</td>
                    <td>
                        <a href="{{ asset('agrements/' . $agrement->document) }}" target="_blank" class="btn-link">
                        <i class='bx bxs-download'></i> Télécharger
                        </a>
                    </td>
                    <td>{{ $agrement->date_deliver }}</td>
                    <td>{{ $agrement->groupement->nom ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Vue -->
                        <a href="{{ route('agrement.show', $agrement->agrement_id) }}" class="btn-action btn-view" title="Voir">
                            <i class='bx bx-show'></i>
                        </a>

                        <!-- Bouton Modifier -->
                        <a href="{{ route('agrement.edit', $agrement->agrement_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class='bx bx-edit'></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('agrement.destroy', $agrement->agrement_id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucun agrément trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $agrements->links() }}
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
    background-color:  #9b87f5;
    color: white;
    text-decoration: none;
}

.btn-edit:hover {
    background-color:  #9b87f5;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
}

.btn-delete:hover {
    background-color: #c82333;
}

.btn-view {
    background-color: #17a2b8;
    color: white;
    text-decoration: none;
}

.btn-view:hover {
    background-color: #138496;
}

.pagination-container {
    text-align: center;
}

.btn-link {
    background-color: #9b87f5;
    border: 1px solid #9b87f5;
    border-radius: 4px;
    padding: 5px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.btn-link:hover {
    color: #0056b3;
    text-decoration: underline;
}
</style>
@endsection