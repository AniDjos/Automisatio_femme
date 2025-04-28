@extends('welcome')

@section('name', 'Liste des Utilisateurs')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Utilisateurs</h1>

    <!-- Bouton pour créer un nouvel utilisateur -->
    <div class="create-button-container" style="margin: 1rem 0; display: flex; justify-content: space-between; align-items: center;">
        <!-- Bouton Ajouter un utilisateur -->
        <a href="{{ route('utilisateurs.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Ajouter un Utilisateur
        </a>
        
        <div class="form-group">
            <input type="text" id="search" name="search" value="{{ request('search') }}"
                placeholder="Rechercher un nom..." class="form-control">
        </div>

        <!-- Bouton Dropdown pour les filtres -->
        <div class="dropdown">
            <button class="btn-dropdown">Filtres <i class='bx bx-filter-alt' style="font-size: 20px; margin-left: 5px;"></i></button>
            <div class="dropdown-menu">
                <a href="{{ route('utilisateurs.index', ['filter' => 'activé']) }}">Activés</a>
                <a href="{{ route('utilisateurs.index', ['filter' => 'désactivé']) }}">Désactivés</a>
                <a href="{{ route('utilisateurs.index', ['role' => 'admin']) }}">Admins</a>
                <a href="{{ route('utilisateurs.index', ['role' => 'Gestionnaire de la plateforme']) }}">Gestionnaire</a>
                <a href="{{ route('utilisateurs.index', ['role' => 'modérateur']) }}">Modérateurs</a>
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <table class="table" id="utilisateursTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($utilisateurs as $utilisateur)
            <tr>
                <td>{{ $utilisateur->id }}</td>
                <td>{{ $utilisateur->nom }}</td>
                <td>{{ $utilisateur->prenom }}</td>
                <td>{{ $utilisateur->email }}</td>
                <td>{{ $utilisateur->role }}</td>
                <td>
                    @if ($utilisateur->statut)
                    <span class="badge badge-success">Activé</span>
                    @else
                    <span class="badge badge-danger">Désactivé</span>
                    @endif
                </td>
                <td class="actions-column">
                    <!-- Bouton Modifier -->
                    <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="btn-action btn-edit"
                        title="Modifier">
                        <i class="bx bx-edit"></i>
                    </a>

                    <!-- Bouton Activer/Désactiver -->
                    <form action="{{ route('utilisateurs.toggleStatus', $utilisateur->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('PUT')
                        @if ($utilisateur->statut)
                        <button type="submit" class="btn-action btn-deactivate" title="Désactiver">
                            <i class="bx bx-power-off"></i>
                        </button>
                        @else
                        <button type="submit" class="btn-action btn-activate" title="Activer">
                            <i class="bx bx-check-circle"></i>
                        </button>
                        @endif
                    </form>

                    <!-- Bouton Supprimer -->
                    <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST"
                        class="form-delete" style="display:inline;">
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
                <td colspan="7" class="no-data">Aucun utilisateur trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="pagination-container">
        {{ $utilisateurs->links() }}
    </div>
</div>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 0rem 0.5rem 17rem;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(155, 135, 245, 0.15);
    font-family: 'Poppins', sans-serif;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    color: #9b87f5;
    position: relative;
    padding-bottom: 10px;
}

.page-title:after {
    content: '';
    position: absolute;
    width: 70px;
    height: 3px;
    background: linear-gradient(90deg, #9b87f5, #7a6ad8);
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    overflow: hidden;
}

.table th,
.table td {
    border: none;
    border-bottom: 1px solid #eee;
    padding: 1rem;
    text-align: left;
    transition: background-color 0.2s;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    position: sticky;
    top: 0;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.actions-column {
    display: flex;
    gap: 8px;
    justify-content: flex-start;
}

.badge {
    padding: 0.5rem 0.8rem;
    font-size: 12px;
    font-weight: 500;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.badge-success {
    background-color: #e6f7ee;
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.badge-danger {
    background-color: #fbeaec;
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.btn-create {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #9b87f5, #7a6ad8);
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
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
    background-color: #eeeafb;
    color: #9b87f5;
    text-decoration: none;
}

.btn-edit:hover {
    background-color: #9b87f5;
    color: white;
}

.btn-delete {
    background-color: #fbeaec;
    color: #dc3545;
    text-decoration: none;
    transform: translateY(-8px);}

.btn-delete:hover {
    background-color: #dc3545;
    color: white;
}

.btn-activate {
    background-color: #e6f7ee;
    color: #28a745;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-activate:hover {
    background-color: #28a745;
    color: white;
}

.btn-deactivate {
    background-color: #fff8e6;
    color: #ffc107;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-deactivate:hover {
    background-color: #ffc107;
    color: white;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.btn-dropdown {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #6c757d, #5a6268);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
}

.btn-dropdown:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(108, 117, 125, 0.4);
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 0.5rem 0;
    z-index: 1000;
    min-width: 180px;
    right: 0;
    top: calc(100% + 10px);
    animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-menu:before {
    content: '';
    position: absolute;
    top: -8px;
    right: 20px;
    width: 15px;
    height: 15px;
    background: white;
    transform: rotate(45deg);
    box-shadow: -3px -3px 5px rgba(0, 0, 0, 0.04);
}

.dropdown-menu a {
    display: block;
    padding: 0.7rem 1.2rem;
    color: #495057;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s ease;
    position: relative;
}

.dropdown-menu a:not(:last-child):after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 1px;
    background: #f5f5f5;
}

.dropdown-menu a:hover {
    background-color: #f8f9fa;
    color: #9b87f5;
    padding-left: 1.5rem;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.form-control {
    width: 300px;
    padding: 0.8rem 1rem;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    outline: none;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
}

.form-control:focus {
    border-color: #9b87f5;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
}

.form-control::placeholder {
    color: #a0aec0;
    font-style: italic;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.no-data {
    text-align: center;
    padding: 2rem !important;
    color: #6c757d;
    font-style: italic;
}

@media screen and (max-width: 992px) {
    .containerer {
        margin: 3rem 1rem;
        padding: 1.5rem;
    }
    
    .create-button-container {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .form-control {
        width: 100%;
    }
    
    .table {
        display: block;
        overflow-x: auto;
    }
    
    .btn-create, .btn-dropdown {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const table = document.getElementById('utilisateursTable');
        const rows = table.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            const searchValue = searchInput.value.toLowerCase();

            rows.forEach(row => {
                const nom = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const prenom = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (nom.includes(searchValue) || prenom.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Animation des badges
        const badges = document.querySelectorAll('.badge');
        badges.forEach(badge => {
            badge.style.opacity = '0';
            setTimeout(() => {
                badge.style.transition = 'opacity 0.5s ease';
                badge.style.opacity = '1';
            }, 100);
        });
    });
</script>
@endsection