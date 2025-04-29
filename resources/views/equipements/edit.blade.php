@extends('welcome')

@section('title', 'Modifier un Équipement')

@section('content')
<div class="elegant-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class="bx bx-edit-alt"></i> Modifier l'Équipement
        </h1>
        <p class="form-subtitle">Mettez à jour les informations de l'équipement</p>
    </div>

    <form action="{{ route('equipement.update', $equipement->equipment_id) }}" method="POST" class="elegant-form">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <!-- Champ Libellé -->
            <div class="form-group">
                <label for="equipment_libelle">
                    <i class="bx bx-rename"></i> Libellé
                </label>
                <div class="input-with-icon">
                    <input type="text" name="equipment_libelle" id="equipment_libelle" 
                           value="{{ old('equipment_libelle', $equipement->equipment_libelle) }}" 
                           placeholder="Nom de l'équipement" required>
                    <i class="bx bx-text"></i>
                </div>
                @error('equipment_libelle')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Statut -->
            <div class="form-group">
                <label for="stat_equipement">
                    <i class="bx bx-stats"></i> Statut
                </label>
                <div class="select-with-icon">
                    <select name="stat_equipement" id="stat_equipement" required>
                        <option value="Disponible" {{ old('stat_equipement', $equipement->stat_equipement) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Indisponible" {{ old('stat_equipement', $equipement->stat_equipement) == 'Indisponible' ? 'selected' : '' }}>Indisponible</option>
                    </select>
                    <i class="bx bx-chevron-down"></i>
                </div>
                @error('stat_equipement')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Difficultés -->
            <div class="form-group">
                <label for="description_difficultie">
                    <i class="bx bx-error-circle"></i> Difficultés
                </label>
                <textarea name="description_difficultie" id="description_difficultie" 
                          rows="3" placeholder="Décrivez les difficultés">{{ old('description_difficultie', $equipement->description_difficultie) }}</textarea>
                @error('description_difficultie')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Besoins -->
            <div class="form-group">
                <label for="description_besoin">
                    <i class="bx bx-help-circle"></i> Besoins
                </label>
                <textarea name="description_besoin" id="description_besoin" 
                          rows="3" placeholder="Décrivez les besoins">{{ old('description_besoin', $equipement->description_besoin) }}</textarea>
                @error('description_besoin')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Groupement -->
            <div class="form-group">
                <label for="groupement_id">
                    <i class="bx bx-group"></i> Groupement
                </label>
                <div class="select-with-icon">
                    <select name="groupement_id" id="groupement_id" required>
                        <option value="">Sélectionnez un groupement</option>
                        @foreach($groupements as $groupement)
                            <option value="{{ $groupement->groupement_id }}" 
                                {{ old('groupement_id', $equipement->groupement_id) == $groupement->groupement_id ? 'selected' : '' }}>
                                {{ $groupement->nom }}
                            </option>
                        @endforeach
                    </select>
                    <i class="bx bx-chevron-down"></i>
                </div>
                @error('groupement_id')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Enregistrer
            </button>
            <a href="{{ route('equipement.index') }}" class="btn btn-secondary">
                <i class="bx bx-x"></i> Annuler
            </a>
        </div>
    </form>
</div>

<!-- Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
:root {
    --primary-color: #6c5ce7;
    --primary-light: #a29bfe;
    --secondary-color: #00cec9;
    --danger-color: #ff7675;
    --text-color: #2d3436;
    --text-light: #636e72;
    --bg-color: #f9f9f9;
    --card-bg: #ffffff;
    --border-color: #dfe6e9;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
}

.elegant-form-container {
    max-width: 800px;
    margin: 5rem auto;
    padding: 0 1.5rem;
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: var(--text-light);
    font-size: 1rem;
    margin-bottom: 0;
}

.elegant-form {
    background-color: var(--card-bg);
    border-radius: 12px;
    box-shadow: var(--shadow);
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 0.75rem;
    color: var(--text-color);
}

.form-group label i {
    font-size: 1.1rem;
    color: var(--primary-color);
}

.input-with-icon, .select-with-icon {
    position: relative;
}

.input-with-icon i, .select-with-icon i {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    pointer-events: none;
}

input, select, textarea {
    width: 100%;
    padding: 0.85rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
}

select {
    appearance: none;
    background-color: white;
}

textarea {
    min-height: 100px;
    resize: vertical;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--danger-color);
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.error-message i {
    font-size: 1rem;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.85rem 1.75rem;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.95rem;
    border: none;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #5649c0;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 92, 231, 0.2);
}

.btn-secondary {
    background-color: white;
    color: var(--text-color);
    border: 1px solid var(--border-color);
}

.btn-secondary:hover {
    background-color: #f8f9fa;
    border-color: var(--primary-light);
}

@media (max-width: 768px) {
    .elegant-form-container {
        margin: 1rem auto;
        padding: 0 1rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection