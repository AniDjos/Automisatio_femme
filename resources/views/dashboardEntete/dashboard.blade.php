<div class="acc">
    <h1>Bienvenue sur <span>MicroGuest</span></h1>
    <p>Votre plateforme de gestion des groupements</p>
    <small>Veuillez contacter le gestionnaire de la plateforme pour qu'il active votre compte <span>microGuestAdmin@gmail.com</span></small>

    <!-- Bouton pour rediriger vers la page de connexion -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-login">Retourner à la connexion</button>
    </form>
</div>
<style>
.acc h1 span {
    color: #9b87f5;
}

.acc {
    max-width: 600px;
    margin: 13rem auto;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.btn-login {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-login:hover {
    background-color: #fff;
    color: #9b87f5;
    border: 1px solid #9b87f5;
}

form {
    margin-top: 2rem;
}

.btn {
    padding: 0.8rem 1.5rem;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color: #fff;
    color: #9b87f5;
    border: 1px solid #9b87f5;
}

.btn-primary {
    background-color: #9b87f5;
    color: white;
}
.btn-primary:hover {
    background-color: #fff;
    color: #9b87f5;
    border: 1px solid #9b87f5;
}

small {
    color: red;
    font-size: 14px;
    margin-top: 1rem;
    display: block;
}

small span {
    color: #9b87f5;
    font-weight: bold;
}
</style>