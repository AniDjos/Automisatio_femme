@extends('welcome')

@section('name', 'Modifier un Arrondissement')

@section('content')
<div class="arrondissement-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class='bx bx-edit'></i> Modifier l'Arrondissement
        </h1>
        <p class="form-subtitle">Mise à jour des informations de l'arrondissement</p>
    </div>

    <form action="{{ route('arrondissements.update', $arrondissement->arrondissement_id) }}" method="POST" class="elegant-form">
        @csrf
        @method('PUT')

        <!-- Nom de l'Arrondissement -->
        <div class="form-group">
            <label for="arrondissement_libelle" class="form-label">
                <i class='bx bx-map-pin'></i> Nom de l'Arrondissement
            </label>
            <div class="input-with-icon">
                <input type="text" name="arrondissement_libelle" id="arrondissement_libelle" 
                       class="form-input" value="{{ $arrondissement->arrondissement_libelle }}" required
                       placeholder="Entrez le nom de l'arrondissement">
                <i class='bx bx-text input-icon'></i>
            </div>
        </div>

        <!-- Commune -->
        <div class="form-group">
            <label for="commune_id" class="form-label">
                <i class='bx bx-map'></i> Commune
            </label>
            <div class="input-with-icon">
                <select name="commune_id" id="commune_id" class="form-input" required>
                    <option value="">Sélectionnez une commune</option>
                    @foreach($communes as $commune)
                        <option value="{{ $commune->commune_id }}" {{ $arrondissement->commune_id == $commune->commune_id ? 'selected' : '' }}>
                            {{ $commune->commune_libelle }}
                        </option>
                    @endforeach
                </select>
                <i class='bx bx-chevron-down input-icon'></i>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">
                <i class='bx bx-save'></i> Mettre à jour
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
.arrondissement-form-container {
    max-width: 1000px;
    margin: 10rem 1rem 1rem 25rem;
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

.form-group {
    margin-bottom: 1.25rem;
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

/* Select Styles */
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
    .arrondissement-form-container {
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