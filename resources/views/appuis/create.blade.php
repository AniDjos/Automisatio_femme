@extends('welcome')

@section('name', 'Enregistrer un Appui')

@section('content')
<div class="elegant-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class='bx bx-plus-circle'></i> Nouvel Appui
        </h1>
        <p class="form-subtitle">Enregistrez les détails du soutien apporté</p>
    </div>

    <form action="{{ route('appuis.store') }}" method="POST" class="elegant-form">
        @csrf
        <div class="form-grid">
            <!-- Type d'Appui -->
            <div class="form-group">
                <label for="type_appui" class="form-label">
                     Type d'Appui
                </label>
                <div class="input-with-icon">
                    <select id="type_appui" name="type_appuis" class="form-input" required>
                        <option value="" disabled selected>Choisissez un type d'appui</option>
                        <option value="financier">Financier</option>
                        <option value="materiel">Matériel</option>
                    </select>
                    <i class='bx bx-chevron-down input-icon'></i>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">
                     Description
                </label>
                <div class="textarea-with-icon">
                    <textarea name="description" id="description" class="form-textarea" 
                              placeholder="Décrivez en détail l'appui fourni" required></textarea>
                    <i class='bx bx-message-detail textarea-icon'></i>
                </div>
            </div>

            <!-- Date -->
            <div class="form-group">
                <label for="date_appuis" class="form-label">
                     Date de l'Appui
                </label>
                <div class="input-with-icon">
                    <input type="date" name="date_appuis" id="date_appuis" class="form-input" required>
                    <i class='bx bx-calendar-event input-icon'></i>
                </div>
            </div>

            <!-- Groupement -->
            <div class="form-group">
                <label for="groupement_id" class="form-label">
                     Groupement
                </label>
                <div class="input-with-icon">
                    <select name="groupement_id" id="groupement_id" class="form-input" required>
                        <option value="">Sélectionnez un groupement</option>
                        @foreach($groupements as $groupement)
                            <option value="{{ $groupement->groupement_id }}">{{ $groupement->nom }}</option>
                        @endforeach
                    </select>
                    <i class='bx bx-chevron-down input-icon'></i>
                </div>
            </div>

            <!-- Structure -->
            <div class="form-group">
                <label for="structure_id" class="form-label">
                     Structure
                </label>
                <div class="input-with-icon">
                    <select name="structure_id" id="structure_id" class="form-input" required>
                        <option value="">Sélectionnez une structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                        @endforeach
                    </select>
                    <i class='bx bx-chevron-down input-icon'></i>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">
                <i class='bx bx-save'></i> Enregistrer
            </button>
        </div>
    </form>
</div>

<style>
/* Variables */
:root {
    --primary: #9b87f5;
    --primary-light: #c5b8fa;
    --primary-dark: #7a6ad8;
    --secondary: #6c5ce7;
    --text: #333;
    --text-light: #666;
    --border: #e0e0e0;
    --border-focus: #9b87f5;
    --background: #f9f9f9;
    --white: #ffffff;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

/* Structure */
.elegant-form-container {
    max-width: 1200px;
    margin: 5rem 1rem 1rem 17rem;
    padding: 2rem;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow);
    font-family: 'Poppins', sans-serif;
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--primary);
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.form-subtitle {
    color: var(--text-light);
    font-size: 0.95rem;
    margin: 0;
}

/* Form Elements */
.elegant-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Deux colonnes de largeur égale */
    gap: 1.5rem; /* Espacement entre les colonnes et les lignes */
}

.form-group {
    display: flex;
    flex-direction: column;
}

.textarea-with-icon {
    grid-column: span 2; /* Étend le champ de texte sur deux colonnes */
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr; /* Une seule colonne sur les petits écrans */
    }
}

.form-label {
    display: block;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label i {
    color: var(--primary);
    font-size: 1.1rem;
}

/* Input Styles */
.input-with-icon {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 0.9rem 1rem 0.9rem 2.5rem;
    font-size: 0.95rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    transition: var(--transition);
    background-color: var(--background);
    color: var(--text);
}

.form-input:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
    background-color: var(--white);
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary);
    font-size: 1.2rem;
    pointer-events: none;
}

/* Textarea Styles */
.textarea-with-icon {
    position: relative;
}

.form-textarea {
    width: 100%;
    min-height: 120px;
    padding: 1rem 1rem 1rem 2.5rem;
    font-size: 0.95rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    transition: var(--transition);
    background-color: var(--background);
    color: var(--text);
    resize: vertical;
}

.form-textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
    background-color: var(--white);
}

.textarea-icon {
    position: absolute;
    left: 1rem;
    top: 1.25rem;
    color: var(--primary);
    font-size: 1.2rem;
}

/* Select Arrow */
select.form-input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: none;
}

/* Button Styles */
.submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.9rem 1.75rem;
    font-size: 1rem;
    font-weight: 500;
    color: var(--white);
    background-color: var(--primary);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 3px 10px rgba(155, 135, 245, 0.3);
    width: 100%;
}

.submit-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(155, 135, 245, 0.4);
}

.submit-btn i {
    font-size: 1.2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .elegant-form-container {
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