@extends('welcome')

@section('name', 'Liste des Appuis')

@section('content')
<div class="appui-container">
    <div class="appui-header">
        <div class="header-content">
            <h1 class="appui-title">
                <i class='bx bx-support'></i> Gestion des Appuis
            </h1>
            <p class="appui-subtitle">Liste des soutiens apportés</p>
        </div>
        
        <a href="{{ route('appuis.create') }}" class="elegant-create-btn">
            <i class='bx bx-plus-circle'></i> Nouvel Appui
        </a>
    </div>

    <div class="appui-filters">
        <!-- Champ de recherche -->
        <input type="text" id="searchInput" placeholder="Rechercher dans le tableau..." class="search-input">

        <!-- Champ de sélection pour filtrer par groupement -->
        <select id="groupementFilter" class="filter-select">
            <option value="">Tous les groupements</option>
            @foreach($groupements as $groupement)
                <option value="{{ $groupement->nom }}">{{ $groupement->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="elegant-card">
        <div class="table-responsive">
            <table class="appui-table" id="appuiTable">
                <thead>
                    <tr>
                        <th class="column-id"><i class='bx bx-id-card'></i> ID</th>
                        <th class="column-type"><i class='bx bx-category'></i> Type</th>
                        <th class="column-desc"><i class='bx bx-text'></i> Description</th>
                        <th class="column-date"><i class='bx bx-calendar'></i> Date</th>
                        <th class="column-group"><i class='bx bx-group'></i> Groupement</th>
                        <th class="column-struct"><i class='bx bx-building'></i> Structure</th>
                        <th class="column-actions"><i class='bx bx-cog'></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appuis as $appui)
                        <tr class="appui-row">
                            <td class="cell-id"><span class="badge">#{{ $appui->appuis_id }}</span></td>
                            <td class="cell-type">
                                <span class="type-badge {{ $appui->type_appuis }}">
                                    {{ ucfirst($appui->type_appuis) }}
                                </span>
                            </td>
                            <td class="cell-desc">{{ Str::limit($appui->description, 50) }}</td>
                            <td class="cell-date">{{ \Carbon\Carbon::parse($appui->date_appuis)->format('d/m/Y') }}</td>
                            <td class="cell-group">{{ $appui->groupement->nom ?? '—' }}</td>
                            <td class="cell-struct">{{ $appui->structure->structure ?? '—' }}</td>
                            <td class="cell-actions">
                                <div class="action-buttons">
                                    <a href="{{ route('appuis.edit', $appui->appuis_id) }}" class="action-btn edit-btn" title="Modifier">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    
                                    <form action="{{ route('appuis.destroy', $appui->appuis_id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet appui ?')">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class='bx bx-info-circle'></i>
                                    <span>Aucun appui enregistré</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="elegant-pagination">
            {{ $appuis->links() }}
        </div>
    </div>
</div>

<style>
/* Variables CSS */
:root {
    --primary: #9b87f5;
    --primary-light: #c5b8fa;
    --primary-dark: #7a6ad8;
    --secondary: #6c5ce7;
    --success: #00b894;
    --warning: #fdcb6e;
    --danger: #ff7675;
    --danger-dark: #e84343;
    --light: #f8f9fa;
    --light-gray: #f1f2f6;
    --medium-gray: #dfe6e9;
    --dark-gray: #636e72;
    --dark: #2d3436;
    --white: #ffffff;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 20px rgba(0,0,0,0.1);
    --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
}

/* Base Styles */
.appui-container {
    max-width: 1400px;
    margin: 5rem 1rem 1rem 17rem;
    padding: 0 1rem;
    font-family: 'Inter', 'Poppins', sans-serif;
}

.appui-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem 0;
    border-bottom: 1px solid var(--medium-gray);
}

.header-content {
    display: flex;
    flex-direction: column;
}

.appui-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.appui-title i {
    color: var(--primary);
    font-size: 1.8rem;
}

.appui-subtitle {
    font-size: 0.9rem;
    color: var(--dark-gray);
    margin: 0.25rem 0 0 0;
    font-weight: 400;
}

.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background-color: var(--light-gray);
    border-radius: var(--radius-sm);
    font-size: 0.85rem;
    color: var(--dark);
}

.elegant-create-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background-color: var(--primary);
    color: var(--white);
    border-radius: var(--radius-sm);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.elegant-create-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.elegant-create-btn i {
    font-size: 1.1rem;
}

.elegant-card {
    background-color: var(--white);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: var(--transition);
}

.elegant-card:hover {
    box-shadow: var(--shadow-md);
}

.table-responsive {
    overflow-x: auto;
    padding: 0 0.5rem;
}

.appui-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.9rem;
}

.appui-table th {
    background-color: var(--light);
    color: var(--dark-gray);
    font-weight: 600;
    padding: 1rem 1.25rem;
    text-align: left;
    border-bottom: 1px solid var(--medium-gray);
    position: sticky;
    top: 0;
    z-index: 10;
}

.appui-table th i {
    margin-right: 0.5rem;
    font-size: 1rem;
    vertical-align: middle;
    color: var(--primary);
}

.appui-table td {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--light-gray);
    color: var(--dark);
    vertical-align: middle;
    line-height: 1.4;
}

.appui-row:hover td {
    background-color: rgba(155, 135, 245, 0.03);
}

.column-id {
    width: 80px;
}

.column-type {
    width: 120px;
}

.column-desc {
    min-width: 200px;
    max-width: 250px;
}

.column-date {
    width: 120px;
}

.column-group, .column-struct {
    width: 150px;
}

.column-actions {
    width: 120px;
}

.cell-id {
    font-weight: 500;
    color: var(--dark-gray);
}

.type-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: capitalize;
}

.type-badge.financier {
    background-color: rgba(0, 184, 148, 0.1);
    color: var(--success);
}

.type-badge.materiel {
    background-color: rgba(108, 92, 231, 0.1);
    color: var(--secondary);
}

.cell-desc {
    font-size: 0.85rem;
    color: var(--dark-gray);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-sm);
    color: var(--white);
    transition: var(--transition);
    text-decoration: none;
    font-size: 1rem;
    border: none;
    cursor: pointer;
}

.edit-btn {
    background-color: var(--primary);
}

.edit-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.delete-btn {
    background-color: var(--danger);
}

.delete-btn:hover {
    background-color: var(--danger-dark);
    transform: translateY(-2px);
}

.delete-form {
    margin: 0;
}

.empty-row td {
    padding: 2rem;
    text-align: center;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: var(--dark-gray);
}

.empty-state i {
    font-size: 2rem;
    color: var(--medium-gray);
}

.elegant-pagination {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
    border-top: 1px solid var(--light-gray);
}

.elegant-pagination .pagination {
    display: flex;
    gap: 0.5rem;
}

.elegant-pagination .page-item.active .page-link {
    background-color: var(--primary);
    border-color: var(--primary);
}

.elegant-pagination .page-link {
    color: var(--primary);
    border-radius: var(--radius-sm);
    padding: 0.5rem 0.9rem;
    transition: var(--transition);
    border: 1px solid var(--medium-gray);
}

.elegant-pagination .page-link:hover {
    background-color: rgba(155, 135, 245, 0.1);
}

.appui-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    align-items: center;
}

.search-input {
    flex: 1;
    padding: 0.8rem;
    font-size: 16px;
    border: 1px solid #E5DEFF;
    border-radius: 8px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #6c5ce7;
    outline: none;
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
}

.filter-select {
    padding: 0.8rem;
    font-size: 16px;
    border: 1px solid #E5DEFF;
    border-radius: 8px;
    background-color: #fff;
    transition: all 0.3s ease;
}

.filter-select:focus {
    border-color: #6c5ce7;
    outline: none;
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
}

/* Responsive */
@media (max-width: 1200px) {
    .appui-container {
        padding: 0 0.5rem;
    }
    
    .appui-table th, 
    .appui-table td {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
    
    .column-desc {
        max-width: 150px;
    }
}

@media (max-width: 768px) {
    .appui-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 100%;
    }
}
</style>

<!-- Include Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const groupementFilter = document.getElementById('groupementFilter');
    const table = document.getElementById('appuiTable');
    const rows = table.querySelectorAll('tbody tr');

    // Fonction pour filtrer les lignes du tableau
    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const groupementValue = groupementFilter.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
            const groupementText = row.querySelector('.cell-group')?.textContent.toLowerCase() || '';

            // Vérifie si la ligne correspond à la recherche et au filtre de groupement
            if (rowText.includes(searchValue) && (groupementValue === '' || groupementText === groupementValue)) {
                row.style.display = ''; // Affiche la ligne
            } else {
                row.style.display = 'none'; // Masque la ligne
            }
        });
    }

    // Écouteurs d'événements pour la recherche et le filtre
    searchInput.addEventListener('input', filterTable);
    groupementFilter.addEventListener('change', filterTable);
});
</script>
@endsection