@extends('welcome')

@section('name', 'Enregistrer un Équipement')

@section('content')
<div class="containerr">
    <h1 class="page-title">Enregistrer un Nouvel Équipement</h1>

    <form action="{{ route('equipement.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="equipment_libelle">Libellé de l'Équipement :</label>
            <input type="text" name="equipment_libelle" id="equipment_libelle" class="form-control" placeholder="Entrez le libellé de l'équipement" required>
        </div>

        <div class="form-group">
            <label for="stat_equipement">Statut de l'Équipement :</label>
            <select name="stat_equipement" id="stat_equipement" class="form-control" required>
                <option value="Disponible">Disponible</option>
                <option value="Indisponible">Indisponible</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description_difficultie">Description des Difficultés :</label>
            <textarea name="description_difficultie" id="description_difficultie" class="form-control" placeholder="Décrivez les difficultés liées à cet équipement"></textarea>
        </div>

        <div class="form-group">
            <label for="description_besoin">Description des Besoins :</label>
            <textarea name="description_besoin" id="description_besoin" class="form-control" placeholder="Décrivez les besoins liés à cet équipement"></textarea>
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

        <button type="submit" class="btn-create">Enregistrer</button>
    </form>
</div>

<style>
.containerr {
    width: 1200px;
    margin: 5rem 1rem 2rem 17rem;
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
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-create {
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

.btn-create:hover {
    background-color: #7a6ad8;
}
</style>
@endsection