@extends('welcome')

@section('name', 'Liste des CPS')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des CPS</h1>

    <!-- Bouton pour créer un nouveau CPS -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('cps.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Ajouter un CPS
        </a>
    </div>

    <!-- Tableau des CPS -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Département</th>
                <th>Commune</th>
                <th>Arrondissement</th>
                <th>Quartier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cps as $item)
                <tr>
                    <td>{{ $item->cps_id }}</td>
                    <td>{{ $item->cps_libelle }}</td>
                    <td>{{ $item->departement->departement_libelle ?? 'N/A' }}</td>
                    <td>{{ $item->commune->commune_libelle ?? 'N/A' }}</td>
                    <td>{{ $item->arrondissement->arrondissement_libelle ?? 'N/A' }}</td>
                    <td>{{ $item->quartier->quartier_libelle ?? 'N/A' }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('cps.edit', $item->cps_id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class="bx bx-edit"></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('cps.destroy', $item->cps_id) }}" method="POST" class="form-delete" style="display:inline;">
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
                    <td colspan="7">Aucun CPS trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $cps->links() }}
    </div>
</div>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 0rem 0rem 17rem;
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
    background-color: #7a6ad8;
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