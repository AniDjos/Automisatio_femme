@extends('welcome')

@section('title', 'Modifier un Agrément')

@section('content')
<div class="elegant-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class="bx bx-edit-alt"></i> Modifier l'Agrément
        </h1>
    </div>

    <form action="{{ route('agrement.update', $agrement->agrement_id) }}" method="POST" enctype="multipart/form-data" class="elegant-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <!-- Champ Structure -->
            <div class="form-group">
                <label for="structure">
                    <i class="bx bx-buildings"></i> Structure
                </label>
                <div class="input-with-icon">
                    <input type="text" id="structure" name="structure" 
                           value="{{ old('structure', $agrement->structure) }}" 
                           placeholder="Nom de la structure" required>
                    <i class="bx bx-edit"></i>
                </div>
                @error('structure')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Référence -->
            <div class="form-group">
                <label for="reference">
                    <i class="bx bx-barcode"></i> Référence
                </label>
                <div class="input-with-icon">
                    <input type="text" id="reference" name="reference" 
                           value="{{ old('reference', $agrement->reference) }}" 
                           placeholder="Référence de l'agrément" required>
                    <i class="bx bx-id-card"></i>
                </div>
                @error('reference')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Date de Livraison -->
            <div class="form-group">
                <label for="date_deliver">
                    <i class="bx bx-calendar"></i> Date de Livraison
                </label>
                <div class="input-with-icon">
                    <input type="date" id="date_deliver" name="date_deliver" 
                           value="{{ old('date_deliver', $agrement->date_deliver) }}" required>
                    <i class="bx bx-calendar-check"></i>
                </div>
                @error('date_deliver')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Champ Groupement -->
            <div class="form-group">
                <label for="groupement_id">
                    <i class="bx bx-group"></i> Groupement
                </label>
                <div class="select-with-icon">
                    <select id="groupement_id" name="groupement_id" required>
                        <option value="" disabled>Sélectionnez un groupement</option>
                        @foreach($groupements as $groupement)
                            <option value="{{ $groupement->groupement_id }}" 
                                {{ old('groupement_id', $agrement->groupement_id) == $groupement->groupement_id ? 'selected' : '' }}>
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

            <!-- Champ Document -->
            <div class="form-group full-width">
                <label for="document">
                    <i class="bx bx-cloud-upload"></i> Document (Laissez vide pour conserver l'actuel)
                </label>
                <div class="file-upload-container">
                    @if($agrement->document)
                    <div class="current-file">
                        <i class="bx bx-file"></i>
                        <span>Document actuel :</span>
                        <a href="{{ asset('storage/' . $agrement->document) }}" target="_blank" class="file-link">
                            <i class="bx bx-download"></i> Télécharger
                        </a>
                    </div>
                    @endif
                    <label for="document" class="file-upload-label">
                        <div class="file-upload-box">
                            <i class="bx bx-file"></i>
                            <span id="file-name">Sélectionner un nouveau fichier</span>
                            <span class="browse-btn">Parcourir</span>
                        </div>
                        <input type="file" id="document" name="document" hidden>
                    </label>
                </div>
                @error('document')
                    <span class="error-message"><i class="bx bx-error"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('agrement.index') }}" class="btn btn-secondary">
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
    --success-color: #00b894;
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
    margin: 5rem 1rem 1rem 30rem;
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
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
    color: var(--primary-color);
    pointer-events: none;
}

input, select {
    width: 100%;
    padding: 0.85rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

input:focus, select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
}

select {
    appearance: none;
    background-color: white;
}

.file-upload-container {
    margin-top: 0.5rem;
}

.current-file {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background-color: #f8f9fa;
    border-radius: 8px;
    font-size: 0.9rem;
}

.current-file i {
    color: var(--success-color);
    font-size: 1.2rem;
}

.file-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    transition: all 0.3s ease;
}

.file-link:hover {
    color: #5649c0;
    text-decoration: underline;
}

.file-link i {
    font-size: 1rem;
}

.file-upload-label {
    cursor: pointer;
}

.file-upload-box {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px dashed var(--border-color);
    border-radius: 8px;
    background-color: #fafafa;
    transition: all 0.3s ease;
}

.file-upload-box:hover {
    border-color: var(--primary-color);
    background-color: rgba(108, 92, 231, 0.03);
}

.file-upload-box i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.file-upload-box span {
    flex-grow: 1;
    font-size: 0.9rem;
    color: var(--text-light);
}

.browse-btn {
    background-color: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.file-upload-box:hover .browse-btn {
    background-color: #5649c0;
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

<script>
// Afficher le nom du fichier sélectionné
document.getElementById('document').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Sélectionner un nouveau fichier';
    document.getElementById('file-name').textContent = fileName;
});
</script>
@endsection