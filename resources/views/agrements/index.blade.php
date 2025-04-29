@extends('welcome')

@section('name', 'Liste des Agréments')

@section('content')
<div class="agrement-container">
    <div class="agrement-header">
        <h1 class="agrement-title">
            <i class='bx bx-file-blank'></i> Liste des Agréments
        </h1>
        
        <a href="{{ route('agrement.create') }}" class="btn btn-create">
            <i class='bx bx-plus-circle'></i> Nouvel Agrément
        </a>
    </div>

    <div class="agrement-card">
        <!-- Tableau des agréments -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Rechercher dans le tableau..." class="search-input">
        </div>

        <div class="table-responsive">
            <table class="agrement-table" id="agrementTable">
                <thead>
                    <tr>
                        <th><i class='bx bx-hash'></i> ID</th>
                        <th><i class='bx bx-building'></i> Structure</th>
                        <th><i class='bx bx-barcode'></i> Référence</th>
                        <th><i class='bx bx-file'></i> Document</th>
                        <th><i class='bx bx-calendar'></i> Date Livraison</th>
                        <th><i class='bx bx-group'></i> Groupement</th>
                        <th><i class='bx bx-cog'></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agrements as $agrement)
                        <tr>
                            <td><span class="badge">#{{ $agrement->agrement_id }}</span></td>
                            <td>{{ $agrement->structure }}</td>
                            <td>{{ $agrement->reference }}</td>
                            <td>
                                <a href="{{ asset('agrements/' . $agrement->document) }}" target="_blank" class="btn-document">
                                    <i class='bx bxs-cloud-download'></i> Télécharger
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($agrement->date_deliver)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge">{{ $agrement->groupement_nom ?? 'Non spécifié' }}</span>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('agrement.show', $agrement->agrement_id) }}" class="btn-action btn-view" title="Voir détails">
                                    <i class='bx bx-show-alt'></i>
                                </a>
                                <a href="{{ route('agrement.edit', $agrement->agrement_id) }}" class="btn-action btn-edit" title="Modifier">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <form action="{{ route('agrement.destroy', $agrement->agrement_id) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agrément ?')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="no-data">
                                <i class='bx bx-info-circle'></i> Aucun agrément trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $agrements->links() }}
        </div>
    </div>
</div>

<style>
/* Base Styles */
:root {
    --primary-color: #7367F0;
    --primary-hover: #5D50E6;
    --secondary-color: #82868B;
    --success-color: #28C76F;
    --danger-color: #EA5455;
    --warning-color: #FF9F43;
    --info-color: #00CFE8;
    --light-color: #F8F8F8;
    --dark-color: #4B4B4B;
    --border-color: #EBE9F1;
    --card-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    --transition: all 0.3s ease;
}

.agrement-container {
    max-width: 1200px;
    margin: 5rem 1rem 2rem 17rem;
    padding: 0 1rem;
    font-family: 'Montserrat', 'Poppins', sans-serif;
}

.agrement-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.agrement-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}



.agrement-title i {
    color: var(--primary-color);
    font-size: 2rem;
}

.agrement-card {
    background: white;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    padding: 1.5rem;
    overflow: hidden;
}
.badge {
    display: inline-block;
    padding: 0.35rem 0.65rem;
    background-color: #f0f0f0;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--text-light);
}
/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    border: none;
}

.btn-create {
    background-color: var(--primary-color);
    color: white;
    box-shadow: 0 3px 10px rgba(115, 103, 240, 0.4);
}

.btn-create:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(115, 103, 240, 0.5);
}

.btn-create i {
    font-size: 1.2rem;
}

.btn-document {
    background-color: rgba(115, 103, 240, 0.1);
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
    text-decoration: none;
}

.btn-document:hover {
    background-color: rgba(115, 103, 240, 0.2);
    color: var(--primary-hover);
}

/* Table Styles */
.table-responsive {
    overflow-x: auto;
}

.agrement-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
}

.agrement-table th {
    background-color: var(--light-color);
    color: var(--dark-color);
    font-weight: 600;
    padding: 1rem 1.25rem;
    white-space: nowrap;
    border-bottom: 1px solid var(--border-color);
}

.agrement-table th i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
    vertical-align: middle;
    color: var(--primary-color);
}

.agrement-table td {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-color);
    color: var(--dark-color);
    vertical-align: middle;
}

.agrement-table tr:last-child td {
    border-bottom: none;
}

.agrement-table tr:hover td {
    background-color: rgba(115, 103, 240, 0.03);
}

/* Badge */
.badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    background-color: rgba(40, 199, 111, 0.12);
    color: var(--success-color);
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    color: white;
    transition: var(--transition);
    text-decoration: none;
    font-size: 1.1rem;
}

.btn-view {
    background-color: var(--info-color);
}

.btn-view:hover {
    background-color: #00b6cc;
    transform: translateY(-2px);
}

.btn-edit {
    background-color: var(--primary-color);
}

.btn-edit:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
}

.btn-delete {
    background-color: var(--danger-color);
    transform: translateY(-19px);
}

.btn-delete:hover {
    background-color: #d94546;
    transform: translateY(-22px);
}

/* No Data */
.no-data {
    text-align: center;
    color: var(--secondary-color);
    padding: 2rem !important;
}

.no-data i {
    margin-right: 0.5rem;
    font-size: 1.2rem;
    vertical-align: middle;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    gap: 0.5rem;
}

.pagination-wrapper .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.pagination-wrapper .page-link {
    color: var(--primary-color);
    border-radius: 6px;
    padding: 0.5rem 0.9rem;
    transition: var(--transition);
}

.pagination-wrapper .page-link:hover {
    background-color: rgba(115, 103, 240, 0.1);
}
.search-container {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.search-input {
    width: 100%;
    max-width: 400px;
    padding: 0.8rem;
    font-size: 16px;
    border: 1px solid #7367F0;
    border-radius: 8px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #7367F0;
    outline: none;
    box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .agrement-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .agrement-card {
        padding: 1rem;
    }
    
    .agrement-table th, 
    .agrement-table td {
        padding: 0.75rem 0.5rem;
    }
}
</style>

<!-- Include Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('agrementTable');
    const rows = table.querySelectorAll('tbody tr');

    // Fonction pour filtrer les lignes du tableau
    searchInput.addEventListener('input', function () {
        const searchValue = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');

            if (rowText.includes(searchValue)) {
                row.style.display = ''; // Affiche la ligne
            } else {
                row.style.display = 'none'; // Masque la ligne
            }
        });
    });
});
</script>
@endsection