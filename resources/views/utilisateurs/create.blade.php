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

    <form action="{{ route('utilisateurs.store') }}" method="POST" class="form-utilisateur">
        @csrf

        <!-- Champ Nom -->
        <div class="form-group">
            <label for="nom">Nom</label>
            <div class="input-icon-wrapper">
                <i class='bx bxs-user' ></i>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" value="{{ old('nom') }}" required>
            </div>
            @error('nom')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Prénom -->
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <div class="input-icon-wrapper">
                <i class='bx bxs-user' ></i>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" value="{{ old('prenom') }}" required>
            </div>
            @error('prenom')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-icon-wrapper">
                <i class='bx bx-folder-minus' ></i>
                <input type="email" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
            </div>
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Mot de Passe -->
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <div class="input-icon-wrapper">
                <i class='bx bxs-lock-open-alt' ></i>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Mot de Passe Confirmation -->
        <div class="form-group">
            <label for="password_confirmation">Confirmer le Mot de Passe</label>
            <div class="input-icon-wrapper">
                <i class='bx bxs-lock-alt' ></i>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Rôle -->
        <div class="form-group">
            <label for="role">Rôle</label>
            <div class="input-icon-wrapper">
                <i class='bx bxs-user-detail' ></i>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Choisissez un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="Gestionnaire de la plateforme">Gestionnaire de la plateforme</option>
                    <option value="Responsable Groupement">Responsable Groupemen</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i>
            Créer l'Utilisateur
        </button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 5rem auto;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.container-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(155, 135, 245, 0.2);
}

.form-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
    color: #7E69AB;
    padding-bottom: 1rem;
    border-bottom: 2px solid #E5DEFF;
}

.form-utilisateur {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 0.6rem;
    color: #403E43;
    letter-spacing: 0.02rem;
}

.input-icon-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.bx {
    position: absolute;
    left: 12px;
    color: #9b87f5;
    font-size: 16px;
    z-index: 1;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.9rem 1rem 0.9rem 2.5rem;
    font-size: 15px;
    border: 1px solid #E5DEFF;
    border-radius: 8px;
    box-sizing: border-box;
    transition: all 0.3s ease;
    background-color: #F6F6F7;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #9b87f5;
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
    background-color: #ffffff;
}

.toggle-password {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: #8A898C;
    cursor: pointer;
    font-size: 16px;
}

.toggle-password:hover {
    color: #9b87f5;
}

.alert {
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 8px;
}

.alert-danger {
    background-color: rgba(234, 56, 76, 0.1);
    border-left: 4px solid #ea384c;
}

.alert-danger ul {
    padding-left: 1rem;
    margin: 0;
}

.alert-danger li {
    color: #ea384c;
    margin-bottom: 0.3rem;
}

.btn-submit {
    grid-column: 1 / -1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 1rem;
    font-size: 16px;
    font-weight: 600;
    color: white;
    background-color: #9b87f5;
    border: 2px solid #9b87f5;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.btn-submit:hover {
    background-color: #7E69AB;
    border-color: #7E69AB;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 5px rgba(155, 135, 245, 0.3);
}

.error-message {
    display: block;
    color: #ea384c;
    font-size: 13px;
    margin-top: 0.5rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .container-form {
        margin: 2rem 1rem;
        padding: 1.5rem;
    }
    
    .form-utilisateur {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = event.currentTarget.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endsection
