@extends('welcome')

@section('name', 'Liste des Membres')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Membres</h1>

    <!-- Formulaire de recherche et de filtre -->
    <form action="{{ route('membres.index') }}" method="GET" class="form-filters">
        <div class="recherche-compact">
            <div class="search-wrapper">
                <div class="input-with-icon">
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Rechercher un nom..." class="form-control">
                    <i class='bx bx-search'></i>
                </div>
            </div>

            <div class="filters-wrapper">
                <div class="select-wrapper">
                    <select id="groupement_id" name="groupement_id" class="form-control">
                        <option value="">Tous les groupements</option>
                        @foreach($groupements as $groupement)
                            <option value="{{ $groupement->groupement_id }}" {{ request('groupement_id') == $groupement->groupement_id ? 'selected' : '' }}>
                                {{ $groupement->groupement_nom }}
                            </option>
                        @endforeach
                    </select>
                    <i class='bx bx-chevron-down'></i>
                </div>

                <div class="select-wrapper">
                    <select id="role" name="role" class="form-control">
                        <option value="">Tous les rôles</option>
                        @foreach($roles as $roleOption)
                            <option value="{{ $roleOption }}" {{ request('role') == $roleOption ? 'selected' : '' }}>
                                {{ $roleOption }}
                            </option>
                        @endforeach
                    </select>
                    <i class='bx bx-chevron-down'></i>
                </div>

                <button type="submit" class="btn-submit">
                    <i class='bx bx-filter-alt'></i> Filtrer
                </button>
            </div>
        </div>
    </form>

    <!-- Bouton pour créer un membre -->
    <div class="create-button-container">
        <a href="{{ route('membres.create') }}" class="btn-create">
            <i class="bx bx-plus"></i> Ajouter un membre
        </a>
    </div>

    <!-- Tableau des membres -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th>Téléphone</th>
                    <th>Groupement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="membres-table">
                @forelse($membres as $membre)
                    <tr class="table-row">
                        <td>{{ $membre->nom_membre }}</td>
                        <td>{{ $membre->prenom_membre }}</td>
                        <td><span class="role-badge">{{ $membre->role_stimule }}</span></td>
                        <td>{{ $membre->telephone }}</td>
                        <td>{{ $membre->groupement_nom ?? 'Non spécifié' }}</td>
                        <td class="actions-cell">
                            <!-- Bouton Voir -->
                            <button class="btn-action btn-view" onclick="openModal({{ json_encode($membre) }})">
                                <i class='bx bx-show-alt'></i>
                            </button>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('membres.edit', $membre->membre_id) }}" class="btn-action btn-edit">
                                <i class="bx bx-edit"></i>
                            </a>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="POST" class="form-delete" id="delete-form-{{ $membre->membre_id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete" title="Supprimer" onclick="confirmDelete({{ $membre->membre_id }})">
                                    <i class='bx bxs-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-table">
                            <div class="empty-state">
                                <i class='bx bx-search-alt bx-tada'></i>
                                <p>Aucun membre trouvé.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $membres->links() }}
    </div>
</div>

<!-- Modale -->
<div id="membreModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Détails du Membre</h5>
            <button class="btn-close" onclick="closeModal()"><i class='bx bx-x'></i></button>
        </div>
        <div class="modal-body">
            <div class="info-group">
                <div class="info-icon"><i class='bx bx-user'></i></div>
                <div class="info-content">
                    <div class="info-label">Nom</div>
                    <div class="info-value" id="modalNom"></div>
                </div>
            </div>
            <div class="info-group">
                <div class="info-icon"><i class='bx bx-user'></i></div>
                <div class="info-content">
                    <div class="info-label">Prénom</div>
                    <div class="info-value" id="modalPrenom"></div>
                </div>
            </div>
            <div class="info-group">
                <div class="info-icon"><i class='bx bx-id-card'></i></div>
                <div class="info-content">
                    <div class="info-label">Rôle</div>
                    <div class="info-value" id="modalRole"></div>
                </div>
            </div>
            <div class="info-group">
                <div class="info-icon"><i class='bx bx-phone'></i></div>
                <div class="info-content">
                    <div class="info-label">Téléphone</div>
                    <div class="info-value" id="modalTelephone"></div>
                </div>
            </div>
            <div class="info-group">
                <div class="info-icon"><i class='bx bx-group'></i></div>
                <div class="info-content">
                    <div class="info-label">Groupement</div>
                    <div class="info-value" id="modalGroupement"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal()">Fermer</button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(membreId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9b87f5',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${membreId}`).submit();
            }
        });
    }

    function openModal(membre) {
        document.getElementById('modalNom').textContent = membre.nom_membre;
        document.getElementById('modalPrenom').textContent = membre.prenom_membre;
        document.getElementById('modalRole').textContent = membre.role_stimule;
        document.getElementById('modalTelephone').textContent = membre.telephone;
        document.getElementById('modalGroupement').textContent = membre.groupement_nom || 'Non spécifié';
        document.getElementById('membreModal').style.display = 'flex';
        
        // Animation d'entrée
        setTimeout(() => {
            document.querySelector('.modal-content').classList.add('modal-active');
        }, 10);
    }

    function closeModal() {
        document.querySelector('.modal-content').classList.remove('modal-active');
        setTimeout(() => {
            document.getElementById('membreModal').style.display = 'none';
        }, 300);
    }

    // Animation au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.table');
        const tableRows = document.querySelectorAll('.table-row');
        
        table.classList.add('fade-in');
        
        tableRows.forEach((row, index) => {
            setTimeout(() => {
                row.classList.add('row-visible');
            }, 100 * index);
        });
    });
</script>

<style>
:root {
    --primary-color: #9b87f5;
    --primary-dark: #7a6ad8;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --success-dark: #218838;
    --danger-color: #dc3545;
    --danger-dark: #a71d2a;
    --white: #ffffff;
    --light: #f8f9fa;
    --dark: #343a40;
    --gray: #6c757d;
    --border-color: #e9ecef;
    --border-radius: 8px;
    --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

.containerer {
    max-width: 1200px;
    margin: 5rem 2rem 2rem 18rem;
    padding: 2rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    animation: slide-up 0.5s ease;
}

@keyframes slide-up {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    color: var(--primary-color);
    position: relative;
    padding-bottom: 15px;
}

.page-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
    border-radius: 3px;
}

.recherche-compact {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.search-wrapper {
    width: 100%;
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
}

.filters-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
}

.select-wrapper {
    position: relative;
    flex: 1;
    min-width: 180px;
}

.select-wrapper i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    pointer-events: none;
}

.form-control {
    width: 100%;
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    transition: var(--transition);
    background-color: var(--white);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.25);
    outline: none;
}

.btn-submit {
    padding: 0.6rem 1rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--white);
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 4px rgba(155, 135, 245, 0.3);
    white-space: nowrap;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(155, 135, 245, 0.4);
}

.btn-submit:active {
    transform: translateY(0);
}

.create-button-container {
    margin: 1rem 0;
    display: flex;
    justify-content: flex-end;
}

.btn-create {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--white);
    text-decoration: none;
    border-radius: var(--border-radius);
    transition: var(--transition);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 3px 6px rgba(155, 135, 245, 0.3);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(155, 135, 245, 0.4);
    color: var(--white);
}

.btn-create:active {
    transform: translateY(0);
}

.table-responsive {
    overflow-x: auto;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 1.5rem;
}

.table th, .table td {
    padding: 1rem;
    text-align: left;
    vertical-align: middle;
}

.table th {
    background-color: var(--light);
    font-weight: 600;
    color: var(--dark);
    position: sticky;
    top: 0;
    z-index: 10;
    border-bottom: 2px solid var(--border-color);
}

.table tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.02);
}

.table-row {
    transition: var(--transition);
    opacity: 0;
    transform: translateY(10px);
}

.table-row:hover {
    background-color: rgba(155, 135, 245, 0.05) !important;
}

.row-visible {
    opacity: 1;
    transform: translateY(0);
}

.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.role-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    background-color: var(--primary-color);
    color: var(--white);
    font-size: 0.85rem;
    font-weight: 500;
}

.actions-cell {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-start;
    align-items: center;
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
    background-color: var(--primary-color);
    color: var(--white);
}

.btn-edit:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.btn-delete {
    background-color: var(--danger-color);
    color: var(--white);
    transform: translateY(-3px);
}

.btn-delete:hover {
    background-color: var(--danger-dark);
    transform: translateY(-6px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.btn-view {
    background-color: var(--success-color);
    color: var(--white);
}

.btn-view:hover {
    background-color: var(--success-dark);
    transform: translateY(-3px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.pagination-container .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    gap: 0.5rem;
}

.pagination-container .pagination li {
    display: inline-block;
}

.pagination-container .pagination li a,
.pagination-container .pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--white);
    color: var(--dark);
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid var(--border-color);
}

.pagination-container .pagination li.active span {
    background-color: var(--primary-color);
    color: var(--white);
    border-color: var(--primary-color);
}

.pagination-container .pagination li a:hover {
    background-color: var(--light);
    color: var(--primary-color);
}

.empty-table {
    text-align: center;
    padding: 3rem 0 !important;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    color: var(--gray);
}

.empty-state i {
    font-size: 3rem;
    color: var(--primary-color);
    opacity: 0.7;
}

/* Styles pour la modale */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(3px);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: var(--white);
    border-radius: var(--border-radius);
    width: 90%;
    max-width: 500px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    transform: scale(0.9);
    opacity: 0;
    transition: all 0.3s ease;
}

.modal-content.modal-active {
    transform: scale(1);
    opacity: 1;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
}

.btn-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray);
    transition: var(--transition);
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.btn-close:hover {
    background-color: rgba(0, 0, 0, 0.05);
    color: var(--dark);
}

.modal-body {
    padding: 1.5rem;
}

.info-group {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.25rem;
    gap: 1rem;
}

.info-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(155, 135, 245, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.info-content {
    flex-grow: 1;
}

.info-label {
    font-size: 0.85rem;
    color: var(--gray);
    margin-bottom: 0.25rem;
}

.info-value {
    font-size: 1rem;
    color: var(--dark);
    font-weight: 500;
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
}

.btn {
    padding: 0.6rem 1.25rem;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 500;
    transition: var(--transition);
}

.btn-secondary {
    background-color: var(--secondary-color);
    color: var(--white);
}

.btn-secondary:hover {
    background-color: #5a6268;
}

@media (max-width: 768px) {
    .containerer {
        margin: 1rem;
        padding: 1rem;
    }
    
    .recherche-compact {
        flex-direction: row;
        align-items: center;
        gap: 1rem;
    }
    
    .search-wrapper {
        flex: 1;
        max-width: 400px;
    }
    
    .filters-wrapper {
        flex: 2;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
    }
    
    .modal-content {
        width: 95%;
    }
}

@media (min-width: 768px) {
    .recherche-compact {
        flex-direction: row;
        align-items: center;
        gap: 1rem;
    }
    
    .search-wrapper {
        flex: 1;
        max-width: 400px;
    }
    
    .filters-wrapper {
        flex: 2;
    }
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(155, 135, 245, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(155, 135, 245, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(155, 135, 245, 0);
    }
}

.bx-tada {
    animation: tada 1.5s ease infinite;
}

@keyframes tada {
    0% {
        transform: scale(1);
    }
    10%, 20% {
        transform: scale(0.9) rotate(-3deg);
    }
    30%, 50%, 70%, 90% {
        transform: scale(1.1) rotate(3deg);
    }
    40%, 60%, 80% {
        transform: scale(1.1) rotate(-3deg);
    }
    100% {
        transform: scale(1) rotate(0);
    }
}
</style>
@endsection
