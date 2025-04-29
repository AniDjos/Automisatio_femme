@extends('welcome')

@section('name', 'Créer une Filière')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class='bx bx-plus-circle'></i> Créer une Nouvelle Filière
        </h1>
        <p class="form-description">Remplissez les informations requises pour créer une nouvelle filière</p>
    </div>

    <form action="{{ route('filiere.store') }}" method="POST" class="elegant-form">
        @csrf
        
        <div class="form-group">
            <div class="input-wrapper">
                <i class="bx bx-user input-icon"></i>
                <input type="text" name="filiere_nom" id="filiere_nom" class="form-input" 
                       placeholder="Entrez le nom de la filière" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class='bx bx-check'></i> Créer la Filière
            </button>
        </div>
    </form>
</div>

<style>
/* Base Styles */
:root {
    --primary-color: #7367F0;
    --primary-light: #9b87f5;
    --primary-hover: #5D50E6;
    --secondary-color: #82868B;
    --success-color: #28C76F;
    --danger-color: #EA5455;
    --warning-color: #FF9F43;
    --info-color: #00CFE8;
    --light-color: #F8F8F8;
    --dark-color: #4B4B4B;
    --border-color: #EBE9F1;
    --card-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    --transition: all 0.3s ease;
}

.form-container {
    max-width: 600px;
    margin: 10rem 1rem 1rem 35rem;
    padding: 2.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    font-family: 'Montserrat', 'Poppins', sans-serif;
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--dark-color);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin: 0 0 0.5rem 0;
}

.form-title i {
    color: var(--primary-color);
}

.form-description {
    color: var(--secondary-color);
    margin: 0;
    font-size: 0.95rem;
}

.elegant-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper .input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%); /* Centre l'icône verticalement */
    color: var(--primary-color);
    font-size: 1.2rem;
    pointer-events: none; /* Empêche l'icône d'interférer avec le clic */
}

.input-wrapper input {
    padding-left: 2.5rem; /* Ajoute un espace pour l'icône */
    padding-right: 1rem;
    width: 100%;
    height: 2.5rem; /* Assure une hauteur uniforme */
    line-height: 1.5; /* Aligne le texte verticalement */
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    background-color: var(--light-color);
    transition: all 0.25s ease;
}

.input-wrapper input::placeholder {
    color: var(--secondary-color); /* Couleur du placeholder */
    font-size: 0.95rem; /* Taille du placeholder */
    line-height: 1.5; /* Aligne le placeholder verticalement */
}

.input-wrapper input:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.2);
    background-color: white;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.9rem 1.75rem;
    font-size: 1rem;
    font-weight: 500;
    color: white;
    background-color: var(--primary-color);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 3px 10px rgba(115, 103, 240, 0.3);
}

.btn-submit:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(115, 103, 240, 0.4);
}

.btn-submit i {
    font-size: 1.2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .form-container {
        margin: 1rem;
        padding: 1.5rem;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
}
</style>

<!-- Include Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection