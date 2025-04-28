@extends('welcome')

@section('name', 'Modifier un Agrément')

@section('content')
<div class="container-form">
    <h1 class="form-title">Modifier un Agrément</h1>
    <form action="{{ route('agrement.update', $agrement->agrement_id) }}" method="POST" enctype="multipart/form-data" class="form-agrement">
        @csrf
        @method('PUT')

        <!-- Champ Structure -->
        <div class="form-group">
            <label for="structure">Structure</label>
            <input type="text" id="structure" name="structure" value="{{ old('structure', $agrement->structure) }}" placeholder="Entrez le nom de la structure" required>
            @error('structure')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Référence -->
        <div class="form-group">
            <label for="reference">Référence</label>
            <input type="text" id="reference" name="reference" value="{{ old('reference', $agrement->reference) }}" placeholder="Entrez la référence" required>
            @error('reference')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Document -->
        <div class="form-group">
            <label for="document">Document (Laissez vide si inchangé)</label>
            <input type="file" id="document" name="document">
            @if($agrement->document)
                <p>Document actuel : <a href="{{ asset('storage/' . $agrement->document) }}" target="_blank">Télécharger</a></p>
            @endif
            @error('document')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Date de Livraison -->
        <div class="form-group">
            <label for="date_deliver">Date de Livraison</label>
            <input type="date" id="date_deliver" name="date_deliver" value="{{ old('date_deliver', $agrement->date_deliver) }}" required>
            @error('date_deliver')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ Groupement -->
        <div class="form-group">
            <label for="groupement_id">Groupement</label>
            <select id="groupement_id" name="groupement_id" required>
                <option value="" disabled>Choisissez un groupement</option>
                @foreach($groupements as $groupement)
                    <option value="{{ $groupement->groupement_id }}" {{ old('groupement_id', $agrement->groupement_id) == $groupement->groupement_id ? 'selected' : '' }}>
                        {{ $groupement->nom }}
                    </option>
                @endforeach
            </select>
            @error('groupement_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Enregistrer les modifications</button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 5rem 2rem 0rem 35rem;
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

.error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 0.5rem;
    display: block;
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

.btn-next:hover,
    .btn-submit:hover {
        color: #9b87f5;
        background-color: #fff;
        border: 1px solid #9b87f5;
    }
</style>
@endsection