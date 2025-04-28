@extends('welcome')

@section('name', 'Liste des Utilisateurs')

@section('content')
<div class="containerer">
    <h1 class="page-title">Liste des Utilisateurs</h1>

    <!-- Bouton pour créer un nouvel utilisateur -->
    <div class="create-button-container" style="margin: 1rem 0; display: flex; justify-content: space-between;">
        <!-- Bouton Ajouter un utilisateur -->
        <a href="{{ route('utilisateurs.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Ajouter un Utilisateur
        </a>

        <!-- Bouton Dropdown pour les filtres -->
        <div class="dropdown">
            <button class="btn-dropdown">Filtres <i class="fas fa-chevron-down"></i></button>
            <div class="dropdown-menu">
                <a href="{{ route('utilisateurs.index', ['filter' => 'activé']) }}">Activés</a>
                <a href="{{ route('utilisateurs.index', ['filter' => 'désactivé']) }}">Désactivés</a>
                <a href="{{ route('utilisateurs.index', ['role' => 'admin']) }}">Admins</a>
                <a href="{{ route('utilisateurs.index', ['role' => 'Gestionnaire de la plateforme']) }}">Gestionnaire </a>
                <a href="{{ route('utilisateurs.index', ['role' => 'modérateur']) }}">Modérateurs</a>
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <table class="table">
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
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="btn-action btn-edit" title="Modifier">
                            <i class="bx bx-edit"></i>
                        </a>

                        <!-- Bouton Activer/Désactiver -->
                        <form action="{{ route('utilisateurs.toggleStatus', $utilisateur->id) }}" method="POST" style="display:inline;">
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
                        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" class="form-delete" style="display:inline;">
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
                    <td colspan="7">Aucun utilisateur trouvé.</td>
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

.badge {
    padding: 0.4rem 0.8rem;
    font-size: 12px;
    font-weight: bold;
    border-radius: 4px;
    text-transform: uppercase;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
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

.btn-activate {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-activate:hover {
    background-color: #218838;
}

.btn-deactivate {
    background-color: #ffc107;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-deactivate:hover {
    background-color: #e0a800;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.btn-dropdown {
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    background-color: #6c757d;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-dropdown:hover {
    background-color: #5a6268;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    padding: 0.5rem 0;
    z-index: 1000;
    min-width: 150px;
}

.dropdown-menu a {
    display: block;
    padding: 0.5rem 1rem;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.dropdown-menu a:hover {
    background-color: #f4f4f4;
}

.dropdown:hover .dropdown-menu {
    display: block;
}
</style>
@endsection