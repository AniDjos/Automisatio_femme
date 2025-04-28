@extends('welcome')

@section('name', 'Liste des Membres')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Membres</h1>

    <!-- Formulaire de recherche et de filtre -->
    <form action="{{ route('membres.index') }}" method="GET" class="form-filters">
        <div class="recherche-display">
            <div class="form-group">
                <label for="search">Rechercher un membre :</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Rechercher un nom..." class="form-control">
            </div>

            <div class="form-group">
                <label for="groupement_id">Filtrer par groupement :</label>
                <select id="groupement_id" name="groupement_id" class="form-control">
                    <option value="">Tous les groupements</option>
                    @foreach($groupements as $groupement)
                        <option value="{{ $groupement->groupement_id }}" {{ request('groupement_id') == $groupement->groupement_id ? 'selected' : '' }}>
                            {{ $groupement->groupement_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="role">Filtrer par rôle :</label>
                <select id="role" name="role" class="form-control">
                    <option value="">Tous les rôles</option>
                    @foreach($roles as $roleOption)
                        <option value="{{ $roleOption }}" {{ request('role') == $roleOption ? 'selected' : '' }}>
                            {{ $roleOption }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">Appliquer les filtres</button>
    </form>

    <!-- Bouton pour créer un membre -->
    <div class="create-button-container" style="margin: 1rem 0;">
        <a href="{{ route('membres.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Ajouter un membre
        </a>
    </div>

    <!-- Tableau des membres -->
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
                <tr>
                    <td>{{ $membre->nom_membre }}</td>
                    <td>{{ $membre->prenom_membre }}</td>
                    <td>{{ $membre->role_stimule }}</td>
                    <td>{{ $membre->telephone }}</td>
                    <td>{{ $membre->groupement_nom ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Voir -->
                        <button class="btn-action btn-view" onclick="openModal({{ json_encode($membre) }})">
                        <i class='bx bx-show-alt'></i>
                        </button>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('membres.edit', $membre->membre_id) }}" class="btn-action btn-edit">
                            <i class="bx bx-edit"></i>
                        </a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="POST" class="form-delete" style="display:inline;">
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
                    <td colspan="8">Aucun membre trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

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
            <button class="btn-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <ul>
                <li><strong>Nom :</strong> <span id="modalNom"></span></li>
                <li><strong>Prénom :</strong> <span id="modalPrenom"></span></li>
                <li><strong>Rôle :</strong> <span id="modalRole"></span></li>
                <li><strong>Téléphone :</strong> <span id="modalTelephone"></span></li>
                <li><strong>Groupement :</strong> <span id="modalGroupement"></span></li>
            </ul>
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
    }

    function closeModal() {
        document.getElementById('membreModal').style.display = 'none';
    }
</script>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 2rem 2rem 18rem;
    padding: 1rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.recherche-display{
    display: flex;
    justify-content: space-between; 
    align-items: center; 
    gap: 3rem; 
    flex-wrap: wrap; 
}

.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    min-width: 300px;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #9b87f5;
    box-shadow: 0 0 5px rgba(155, 135, 245, 0.5);
    outline: none;
}

.btn-submit {
    padding: 0.8rem 1.5rem;
    background-color: #9b87f5;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #7a6ad8;
}

.btn-create {
    padding: 0.8rem 1.5rem;
    background-color: #9b87f5;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-create:hover {
    background-color: #7a6ad8;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
    padding-top: 1rem;
}

.table th, .table td {
    padding: 0.8rem;
    border: 1px solid #ddd;
    text-align: left;
}

.table th {
    background-color: #f1f1f1;
    font-weight: bold;
}

.btn-action {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-edit {
    background-color: #9b87f5;
    color: white;
}

.btn-edit:hover {
    background-color: #7a6ad8;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
}

.btn-delete:hover {
    background-color: #a71d2a;
}

.btn-view {
    background-color: #28a745; /* Couleur verte */
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-view:hover {
    background-color: #218838;
}

.pagination-container {
    text-align: center;
}

.pagination-container .pagination li a {
    color: #9b87f5;
    transition: color 0.3s ease;
}

.pagination-container .pagination li a:hover {
    color: #7a6ad8;
}

/* Styles pour la modale */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: #fff;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.modal-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.btn-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #333;
}

.modal-body {
    display:block;
    justify-content:left;
    align-items:left;
}
.modal-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.modal-body ul li {
    margin-bottom: 10px;
    font-size: 16px;
    color: #555;
}

.modal-body ul li strong {
    color: #9b87f5;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #5a6268;
}
</style>
@endsection