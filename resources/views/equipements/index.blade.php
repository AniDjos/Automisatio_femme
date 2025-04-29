@extends('welcome')

@section('name', 'Liste des Équipements')

@section('content')
<div class="equipment-container">
    <div class="equipment-header">
        <div class="header-content">
            <h1 class="equipment-title">
                <i class='bx bx-chip'></i> Inventaire des Équipements
            </h1>
            <p class="equipment-subtitle">Gestion du parc matériel</p>
        </div>

        <a href="{{ route('equipement.create') }}" class="elegant-create-btn">
            <i class='bx bx-plus'></i> Nouvel Équipement
        </a>
    </div>

    <div class="equipment-filters">
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
            <table class="equipment-table" id="equipmentTable">
                <thead>
                    <tr>
                        <th class="column-id"><i class='bx bx-id-card'></i> ID</th>
                        <th class="column-name"><i class='bx bx-purchase-tag'></i> Libellé</th>
                        <th class="column-status"><i class='bx bx-stats'></i> Statut</th>
                        <th class="column-difficulties"><i class='bx bx-error-circle'></i> Difficultés</th>
                        <th class="column-needs"><i class='bx bx-requirement'></i> Besoins</th>
                        <th class="column-group"><i class='bx bx-group'></i> Groupement</th>
                        <th class="column-actions"><i class='bx bx-cog'></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($equipements as $equipement)
                    <tr class="equipment-row">
                        <td class="cell-id"><span class="badge">#{{ $equipement->equipment_id }}</span></td>
                        <td class="cell-name">{{ $equipement->equipment_libelle }}</td>
                        <td class="cell-status">
                            <span
                                class="status-badge {{ strtolower(str_replace(' ', '-', $equipement->stat_equipement)) }}">
                                {{ $equipement->stat_equipement }}
                            </span>
                        </td>
                        <td class="cell-difficulties">{{ $equipement->description_difficultie ?? '—' }}</td>
                        <td class="cell-needs">{{ $equipement->description_besoin ?? '—' }}</td>
                        <td class="cell-group">{{ $equipement->groupement->nom ?? '—' }}</td>
                        <td class="cell-actions">
                            <div class="action-buttons">
                                <a href="{{ route('equipement.edit', $equipement->equipment_id) }}"
                                    class="action-btn edit-btn" title="Modifier">
                                    <i class='bx bx-edit-alt'></i>
                                </a>

                                <form action="{{ route('equipement.destroy', $equipement->equipment_id) }}"
                                    method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')">
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
                                <i class='bx bx-package'></i>
                                <span>Aucun équipement enregistré</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="elegant-pagination">
            {{ $equipements->links() }}
            <!-- Pagination links -->
        </div>
    </div>

    <style>
    /* Variables CSS */
    :root {
        --primary: #6c5ce7;
        --primary-light: #a29bfe;
        --primary-dark: #5649c0;
        --secondary: #00cec9;
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
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
    }

    /* Base Styles */
    .equipment-container {
        max-width: 1400px;
        margin: 5rem 1rem 2rem 17rem;
        padding: 0 1rem;
        font-family: 'Inter', 'Poppins', sans-serif;
    }

    .equipment-header {
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

    .equipment-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .equipment-title i {
        color: var(--primary);
        font-size: 1.8rem;
    }

    .equipment-subtitle {
        font-size: 0.9rem;
        color: var(--dark-gray);
        margin: 0.25rem 0 0 0;
        font-weight: 400;
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


    .badge {
        display: inline-block;
        padding: 0.35rem 0.65rem;
        background-color: var(--light-gray);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--dark-gray);
    }

    .table-responsive {
        overflow-x: auto;
        padding: 0 0.5rem;
    }

    .equipment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.9rem;
    }

    .equipment-table th {
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

    .equipment-table th i {
        margin-right: 0.5rem;
        font-size: 1rem;
        vertical-align: middle;
        color: var(--primary);
    }

    .equipment-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--light-gray);
        color: var(--dark);
        vertical-align: middle;
        line-height: 1.4;
    }

    .equipment-row:hover td {
        background-color: rgba(108, 92, 231, 0.03);
    }

    .column-id {
        width: 80px;
    }

    .column-name {
        width: 180px;
    }

    .column-status {
        width: 120px;
    }

    .column-difficulties,
    .column-needs {
        max-width: 250px;
        min-width: 200px;
    }

    .column-group {
        width: 150px;
    }

    .column-actions {
        width: 120px;
    }

    .cell-id {
        font-weight: 500;
        color: var(--dark-gray);
    }

    .cell-name {
        font-weight: 500;
    }

    .cell-difficulties,
    .cell-needs {
        font-size: 0.85rem;
        color: var(--dark-gray);
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-badge.active {
        background-color: rgba(0, 184, 148, 0.1);
        color: var(--success);
    }

    .status-badge.inactive {
        background-color: rgba(255, 118, 117, 0.1);
        color: var(--danger);
    }

    .status-badge.maintenance {
        background-color: rgba(253, 203, 110, 0.1);
        color: #e17055;
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
        background-color: rgba(108, 92, 231, 0.1);
    }

    .equipment-filters {
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
        .equipment-container {
            padding: 0 0.5rem;
        }

        .equipment-table th,
        .equipment-table td {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .column-difficulties,
        .column-needs {
            max-width: 180px;
            min-width: 150px;
        }
    }

    @media (max-width: 768px) {
        .equipment-header {
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
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const groupementFilter = document.getElementById('groupementFilter');
        const table = document.getElementById('equipmentTable');
        const rows = table.querySelectorAll('tbody tr');

        // Fonction pour filtrer les lignes du tableau
        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const groupementValue = groupementFilter.value.toLowerCase();

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                const groupementText = row.querySelector('.cell-group')?.textContent.toLowerCase() ||
                '';

                // Vérifie si la ligne correspond à la recherche et au filtre de groupement
                if (rowText.includes(searchValue) && (groupementValue === '' || groupementText ===
                        groupementValue)) {
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