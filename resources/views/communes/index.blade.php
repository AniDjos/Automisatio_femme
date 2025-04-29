@extends('welcome')

@section('name', 'Liste des Communes')

@section('content')
<div class="commune-container">
    <div class="commune-header">
        <div class="header-content">
            <h1 class="commune-title">
                <i class='bx bx-map'></i> Gestion des Communes
            </h1>
            <p class="commune-subtitle">Liste des collectivités locales</p>
        </div>
        
        <a href="{{ route('communes.create') }}" class="elegant-create-btn">
            <i class='bx bx-plus-circle'></i> Nouvelle Commune
        </a>
    </div>

    <!-- Champ de recherche -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher dans le tableau..." class="search-input">
    </div>

    <div class="elegant-card">
        <div class="table-responsive">
            <table class="commune-table" id="communeTable">
                <thead>
                    <tr>
                        <th class="column-id"><i class='bx bx-id-card'></i> ID</th>
                        <th class="column-name"><i class='bx bx-map-pin'></i> Commune</th>
                        <th class="column-department"><i class='bx bx-buildings'></i> Département</th>
                        <th class="column-actions"><i class='bx bx-cog'></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($communes as $commune)
                        <tr class="commune-row">
                            <td class="cell-id"><span class="badge">#{{ $commune->commune_id }}</span></td>
                            <td class="cell-name">{{ $commune->commune_libelle }}</td>
                            <td class="cell-department">
                                <span class="department-badge">
                                    {{ $commune->departement->departement_libelle ?? '—' }}
                                </span>
                            </td>
                            <td class="cell-actions">
                                <div class="action-buttons">
                                    <a href="{{ route('communes.edit', $commune->commune_id) }}" class="action-btn edit-btn" title="Modifier">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    
                                    <form action="{{ route('communes.destroy', $commune->commune_id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commune ?')">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class='bx bx-map-alt'></i>
                                    <span>Aucune commune enregistrée</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="elegant-pagination">
            {{ $communes->links() }}
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
    --warning: #ffc107;
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
.commune-container {
    max-width: 1200px;
    margin: 5rem 1rem 1rem 17rem;
    padding: 0 1rem;
    font-family: 'Inter', 'Poppins', sans-serif;
}

.commune-header {
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

.badge{
    background-color: var(--dark-gray);
    color: var(--primary);
    padding: 0.25rem 0.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
}

.commune-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.commune-title i {
    color: var(--primary);
    font-size: 1.8rem;
}

.commune-subtitle {
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

.table-responsive {
    overflow-x: auto;
}

.commune-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
}

.commune-table th {
    background-color: var(--light);
    color: var(--dark-gray);
    font-weight: 600;
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid var(--medium-gray);
}

.commune-table th i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
    vertical-align: middle;
    color: var(--primary);
}

.commune-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--light-gray);
    color: var(--dark);
    vertical-align: middle;
}

.commune-row:hover td {
    background-color: rgba(155, 135, 245, 0.03);
}

.column-id {
    width: 80px;
}

.column-name {
    min-width: 200px;
}

.column-department {
    min-width: 200px;
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

.department-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    background-color: rgba(108, 92, 231, 0.1);
    color: var(--secondary);
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-sm);
    color: var(--white);
    transition: var(--transition);
    text-decoration: none;
    font-size: 1.1rem;
    border: none;
    cursor: pointer;
}

.edit-btn {
    background-color: var(--warning);
}

.edit-btn:hover {
    background-color: #e0a800;
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

/* Responsive */
@media (max-width: 768px) {
    .commune-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .elegant-card {
        padding: 1rem;
    }
    
    .commune-table th, 
    .commune-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<!-- Include Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('communeTable');
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