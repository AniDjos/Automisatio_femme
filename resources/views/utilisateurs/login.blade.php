@extends('welcome')

@section('name', 'Connexion')

@section('content')
<div class="container-form">
    <h1 class="form-title">Connexion</h1>
    <form action="{{ route('login') }}" method="POST" class="form-login">
        @csrf

        <!-- Champ Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Mot de passe -->
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Se connecter</button>
        <div class="retour">
        <a href="{{ route('App_acceuil') }}">retour</a>
        </div>
    </form>
</div>

<style>
.container-form {
    max-width: 400px;
    margin: 13rem auto;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.inscrire a{
    color: blue;
    text-decoration: none;
}

.retour{
    text-align: center;
    margin-top: 1rem;
    font-size: 14px;
    color: #737373;
    padding: 0.5rem; 
    border-radius: 4px;
    background-color: #f0f0f0;
    transition: background-color 0.3s ease;
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

.form-group input {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #9b87f5;
    outline: none;
}

.error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 0.5rem;
    display: block;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 0.9rem;
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