@extends('welcome')

@section('name', 'Créer un Utilisateur')

@section('content')
<div class="container-form">
    <h1 class="form-title">Créer un Utilisateur</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="form-utilisateur">
        @csrf

        <!-- Champ Nom -->
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" value="{{ old('nom') }}" required>
            @error('nom')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Prénom -->
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" value="{{ old('prenom') }}" required>
            @error('prenom')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Mot de Passe -->
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Confirmation du Mot de Passe -->
        <div class="form-group">
            <label for="password_confirmation">Confirmer le Mot de Passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
            @error('password_confirmation')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Rôle -->
        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Choisissez un rôle</option>
                <option value="admin">Admin</option>
                <option value="Gestionnaire de la plateforme">Gestionnaire de la plateforme</option>
                <option value="moderateur">Simple Utilisateur</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Créer l'Utilisateur</button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 3rem auto;
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

.error-message {
    color: red;
    font-size: 12px;
    margin-top: 0.5rem;
}
</style>
@endsection