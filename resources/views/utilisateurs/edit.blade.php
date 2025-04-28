@extends('welcome')

@section('name', 'Modifier un Utilisateur')

@section('content')
<div class="container-form">
    <h1 class="form-title">Modifier l'Utilisateur</h1>
    <form action="{{ route('utilisateurs.update', $utilisateur->utilisateur_id) }}" method="POST" class="form-utilisateur">
        @csrf
        @method('PUT')

        <!-- Champ Nom -->
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ $utilisateur->nom }}" placeholder="Entrez le nom" required>
        </div>

        <!-- Champ Prénom -->
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ $utilisateur->prenom }}" placeholder="Entrez le prénom" required>
        </div>

        <!-- Champ Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $utilisateur->email }}" placeholder="Entrez l'email" required>
        </div>

        <!-- Champ Mot de Passe -->
        <div class="form-group">
            <label for="mdp">Mot de Passe</label>
            <input type="password" id="mdp" name="mdp" value="{{ $utilisateur->mdp }}" placeholder="Entrez le mot de passe" required>

        <!-- Champ Rôle -->
        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" required>
                <option value="" disabled>Choisissez un rôle</option>
                <option value="admin" {{ $utilisateur->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="utilisateur" {{ $utilisateur->role == 'utilisateur' ? 'selected' : '' }}>Gestionnaire de la plateforme</option>
                <option value="moderateur" {{ $utilisateur->role == 'moderateur' ? 'selected' : '' }}>Simple Utilisateur</option>
            </select>
        </div>

        <!-- Champ Statut -->
        <div class="form-group">
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
                <option value="1" {{ $utilisateur->statut ? 'selected' : '' }}>Activé</option>
                <option value="0" {{ !$utilisateur->statut ? 'selected' : '' }}>Désactivé</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Mettre à jour l'Utilisateur</button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 4.5rem auto;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.form-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #9b87f5;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #555;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #9b87f5;
    outline: none;
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 0.8rem;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    color: #9b87f5;
    background-color: #fff;
    border: 1px solid #9b87f5;
}
</style>
@endsection