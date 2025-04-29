@extends('welcome')

@section('title', 'Liste des Arrondissements')

@section('content')
<div class="elegant-container">
    <div class="header-section">
        <h1 class="page-title">
            <i class='bx bx-map-alt'></i> Gestion des Arrondissements
        </h1>
        <p class="page-subtitle">Liste complète des arrondissements enregistrés</p>
    </div>

    <!-- Barre d'actions -->
    <div class="action-bar">
        <a href="{{ route('arrondissements.create') }}" class="btn btn-primary">
            <i class='bx bx-plus'></i> Nouvel Arrondissement
        </a>
        <div class="search-box">
            <i class='bx bx-search'></i>
            <input type="text" id="searchInput" placeholder="Rechercher dans le tableau..." class="search-input">
        </div>
    </div>

    <!-- Tableau des arrondissements -->
    <div class="card">
        <div class="table-responsive">
            <table class="elegant-table" id="arrondissementTable">
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
                            <td><span class="badge">#{{ $arrondissement->arrondissement_id }}</span></td>
                            <td>
                                <div class="entity-info">
                                    <i class='bx bx-map-pin'></i>
                                    <span>{{ $arrondissement->arrondissement_libelle }}</span>
                                </div>
                            </td>
                            <td>{{ $arrondissement->commune->commune_libelle ?? 'Non spécifié' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('arrondissements.edit', $arrondissement->arrondissement_id) }}" 
                                       class="btn-icon btn-edit" title="Modifier">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <form action="{{ route('arrondissements.destroy', $arrondissement->arrondissement_id) }}" 
                                          method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" 
                                                title="Supprimer"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet arrondissement ?')">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class='bx bx-info-circle'></i>
                                <span>Aucun arrondissement trouvé dans la base de données</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($arrondissements->count())
        <div class="table-footer">
            <div class="pagination-info">
                Affichage de {{ $arrondissements->firstItem() }} à {{ $arrondissements->lastItem() }} sur {{ $arrondissements->total() }} entrées
            </div>
            <div class="pagination-links">
                {{ $arrondissements->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
:root {
    --primary-color: #6c5ce7;
    --primary-light: #a29bfe;
    --secondary-color: #00cec9;
    --danger-color: #ff7675;
    --success-color: #00b894;
    --text-color: #2d3436;
    --text-light: #636e72;
    --bg-color: #f9f9f9;
    --card-bg: #ffffff;
    --border-color: #dfe6e9;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
}

.elegant-container {
    max-width: 1200px;
    margin: 5rem 1rem 1rem 17rem;
    padding: 0 1.5rem;
}

.header-section {
    margin-bottom: 2rem;
    text-align: center;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--text-light);
    font-size: 1rem;
    margin-bottom: 0;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #5649c0;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 92, 231, 0.2);
}

.search-box {
    position: relative;
    flex-grow: 1;
    max-width: 400px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
}

.card {
    background-color: var(--card-bg);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow: hidden;
}

.table-responsive {
    overflow-x: auto;
}

.elegant-table {
    width: 100%;
    border-collapse: collapse;
}

.elegant-table th {
    background-color: #f8f9fa;
    color: var(--text-light);
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.elegant-table td {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    font-size: 0.95rem;
    vertical-align: middle;
}

.elegant-table tr:last-child td {
    border-bottom: none;
}

.elegant-table tr:hover td {
    background-color: rgba(108, 92, 231, 0.03);
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

.entity-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.entity-info i {
    color: var(--primary-color);
    font-size: 1.1rem;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: white;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 1rem;
}

.btn-edit {
    background-color: var(--primary-color);
}

.btn-delete {
    background-color: var(--danger-color);
    transform: translateY(-19px);
}

.btn-delete:hover {
    background-color: #d63031;
    transform: translateY(-22px);
    box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
}

.btn-icon:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.empty-state {
    text-align: center;
    padding: 2rem !important;
    color: var(--text-light);
}

.empty-state i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    display: block;
}

.table-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-color);
    font-size: 0.9rem;
    color: var(--text-light);
}

.pagination-links .pagination {
    display: flex;
    gap: 0.5rem;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pagination-links .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.pagination-links .page-link {
    padding: 0.5rem 0.9rem;
    border-radius: 6px;
    color: var(--text-color);
    text-decoration: none;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.pagination-links .page-link:hover {
    background-color: #f0f0f0;
}
.search-box {
    position: relative;
    flex-grow: 1;
    max-width: 400px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
} 

@media (max-width: 768px) {
    .action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        max-width: 100%;
    }
    
    .elegant-table th, 
    .elegant-table td {
        padding: 0.75rem;
    }
    
    .table-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('arrondissementTable');
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