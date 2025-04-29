@extends('welcome')

@section('title', 'Modifier une Filière')

@section('content')
<div class="elegant-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class="bx bx-edit"></i> Modifier la Filière
        </h1>
        <p class="form-subtitle">Mettez à jour les informations de la filière</p>
    </div>

    <form action="{{ route('filiere.update', $filiere->filiere_id) }}" method="POST" class="elegant-form">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="filiere_nom">
                <i class="bx bx-category"></i> Nom de la Filière
            </label>
            <div class="input-with-icon">
                <input type="text" name="filiere_nom" id="filiere_nom" 
                       value="{{ old('filiere_nom', $filiere->filiere_nom) }}" 
                       placeholder="Entrez le nom de la filière" required>
                <i class="bx bx-text"></i>
            </div>
            @error('filiere_nom')
                <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('filiere.index') }}" class="btn btn-secondary">
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
    max-width: 600px;
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

.form-group {
    margin-bottom: 2rem;
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

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    pointer-events: none;
}

input {
    width: 100%;
    padding: 0.85rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
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