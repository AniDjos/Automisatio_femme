@extends('welcome')

@section('name', 'Enregistrer un Appui')

@section('content')
<div class="containerer">
    <h1 class="page-title">Enregistrer un Nouvel Appui</h1>

    <form action="{{ route('appuis.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type_appui">Type d'Appui</label>
            <select id="type_appui" name="type_appuis">
            <option value="" disabled selected>Choisissez un type d'appui</option>
            <option value="financier">Financier</option>
            <option value="materiel">Matériel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" class="form-control" placeholder="Décrivez l'appui" required></textarea>
        </div>

        <div class="form-group">
            <label for="date_appuis">Date de l'Appui :</label>
            <input type="date" name="date_appuis" id="date_appuis" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="groupement_id">Groupement :</label>
            <select name="groupement_id" id="groupement_id" class="form-control" required>
                <option value="">-- Sélectionnez un groupement --</option>
                @foreach($groupements as $groupement)
                    <option value="{{ $groupement->groupement_id }}">{{ $groupement->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="structure_id">Structure :</label>
            <select name="structure_id" id="structure_id" class="form-control" required>
                <option value="">-- Sélectionnez une structure --</option>
                @foreach($structures as $structure)
                    <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-submit">Enregistrer</button>
    </form>
</div>

<style>
.containerer {
    max-width: 600px;
    margin: 5rem auto;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.page-title {
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
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
}

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
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
    }
.form-control {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-submit {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
    }
.btn-next:hover,
    .btn-submit:hover {
        color: #9b87f5;
        background-color: #fff;
        border: 1px solid #9b87f5;
    }
</style>
@endsection