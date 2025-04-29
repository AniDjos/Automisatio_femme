@extends('welcome')

@section('name', 'Liste des Quartiers')

@section('content')
<div class="containerer">
    <h1 class="page-title">
        <i class="fas fa-map-marked-alt page-icon"></i>
        Liste des Quartiers
    </h1>

    <!-- Bouton pour créer un nouveau quartier -->
    <div class="create-button-container">
        <a href="{{ route('quartier.create') }}" class="btn-create">
            <i class="fas fa-plus-circle"></i> Ajouter un Quartier
        </a>
    </div>

    <!-- Tableau des quartiers -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th><i class="fas fa-map-marker-alt th-icon"></i> ID</th>
                    <th><i class="fas fa-home th-icon"></i> Nom du Quartier</th>
                    <th><i class="fas fa-map-marker-alt th-icon"></i> Arrondissement</th>
                    <th><i class="fas fa-city th-icon"></i> Commune</th>
                    <th><i class="fas fa-tools th-icon"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quartiers as $quartier)
                    <tr>
                        <td><span class="badge">#{{ $quartier->quartier_id }}</span></td>
                        <td>{{ $quartier->quartier_libelle }}</td>
                        <td>{{ $quartier->arrondissement->arrondissement_libelle }}</td>
                        <td>{{ $quartier->arrondissement->commune->commune_libelle }}</td>
                        <td class="actions-cell">
                            <!-- Bouton Modifier -->
                            <a href="{{ route('quartier.edit', $quartier->quartier_id) }}" class="btn-action btn-edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('quartier.destroy', $quartier->quartier_id) }}" method="POST" class="form-delete" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce quartier?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <div class="empty-state-content">
                                <i class="fas fa-search empty-icon"></i>
                                <p>Aucun quartier trouvé.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $quartiers->links() }}
    </div>
</div>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 2rem 2rem 17rem;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.containerer:hover {
    box-shadow: 0 15px 35px rgba(155, 135, 245, 0.15);
}

.badge {
    background-color: #E5DEFF;
    color:rgb(104, 101, 110);
    padding: 0.4rem 0.4rem;
    border-radius: 100%;
    font-size: 14px;
    font-weight: 500;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
    color: #7E69AB;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-bottom: 1rem;
    border-bottom: 2px solid #E5DEFF;
}

.page-icon {
    margin-right: 12px;
    color: #9b87f5;
    font-size: 28px;
}

.create-button-container {
    margin: 1.5rem 0;
    display: flex;
    justify-content: flex-end;
}

.btn-create {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0.8rem 1.5rem;
    font-size: 15px;
    font-weight: 600;
    color: white;
    background-color: #9b87f5;
    border: 2px solid #9b87f5;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(155, 135, 245, 0.2);
}

.btn-create:hover {
    transform: translateY(-2px);
    background-color: #7a6ad8;
    box-shadow: 0 6px 15px rgba(155, 135, 245, 0.3);
}

.table-responsive {
    overflow-x: auto;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.table th, .table td {
    border: none;
    padding: 1rem 1.2rem;
    text-align: left;
    vertical-align: middle;
}

.table th {
    background-color: #f8f7fd;
    font-weight: 600;
    color: #403E43;
    font-size: 15px;
    border-bottom: 2px solid #E5DEFF;
    position: relative;
    padding-left: 2.5rem;
}

.th-icon {
    color: #9b87f5;
    position: absolute;
    left: 1rem;
    font-size: 14px;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:nth-child(even) {
    background-color: #fbfaff;
}

.table tbody tr:hover {
    background-color: #f4f1ff;
}

.actions-cell {
    white-space: nowrap;
    display: flex;
    gap: 8px;
    justify-content: flex-start;
}

.btn-action {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1rem;
    padding: 0;
    margin: 0;
}
.btn-action i {
    font-size: 1.2rem;
    line-height: 1;
}
.btn-edit {
    background-color: #9b87f5;
    color: white;
    text-decoration: none;
}

.btn-edit:hover {
    background-color: #7a6ad8;
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(155, 135, 245, 0.3);
}

.btn-delete {
    background-color: #ff6b6b;
    color: white;
    text-decoration: none;
    transform: translateY(-8px);
    border: none;
}

.btn-delete:hover {
    background-color: #ff5252;
    transform: translateY(-10px);
    box-shadow: 0 3px 8px rgba(255, 107, 107, 0.3);
}

.empty-state {
    text-align: center;
    padding: 3rem !important;
}

.empty-state-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.empty-icon {
    font-size: 3rem;
    color: #E5DEFF;
    margin-bottom: 1rem;
}

.empty-state-content p {
    color: #8A898C;
    font-size: 16px;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-container nav {
    display: flex;
    justify-content: center;
}

/* .pagination-container nav div, 
.pagination-container nav span, 
.pagination-container nav a {
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 6px;
    color: black;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination-container nav span.active,
.pagination-container nav span[aria-current="page"] {
    background-color: #E5DEFF;
    color: white;
}

.pagination-container nav a:hover {
    background-color: #E5DEFF;
} */

@media (max-width: 1024px) {
    .containerer {
        margin: 5rem 1rem 1rem 1rem;
        padding: 1.5rem;
    }
    
    .table th, .table td {
        padding: 0.8rem;
    }
    
    .actions-cell {
        display: flex;
        flex-direction: row;
    }
    
    .page-title {
        font-size: 24px;
    }
}

@media (max-width: 768px) {
    .table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}
</style>

<!-- N'oubliez pas d'inclure Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
