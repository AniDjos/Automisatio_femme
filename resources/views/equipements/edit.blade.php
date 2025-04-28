@extends('welcome')

@section('name', 'Modifier un Équipement')

@section('content')
<div class="containerer">
    <h1 class="page-title">Modifier l'Équipement</h1>

    <form action="{{ route('equipement.update', $equipement->equipment_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="equipment_libelle">Libellé de l'Équipement :</label>
            <input type="text" name="equipment_libelle" id="equipment_libelle" class="form-control" value="{{ $equipement->equipment_libelle }}" required>
        </div>

        <div class="form-group">
            <label for="stat_equipement">Statut de l'Équipement :</label>
            <select name="stat_equipement" id="stat_equipement" class="form-control" required>
                <option value="Disponible" {{ $equipement->stat_equipement == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Indisponible" {{ $equipement->stat_equipement == 'Indisponible' ? 'selected' : '' }}>Indisponible</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description_difficultie">Description des Difficultés :</label>
            <textarea name="description_difficultie" id="description_difficultie" class="form-control">{{ $equipement->description_difficultie }}</textarea>
        </div>

        <div class="form-group">
            <label for="description_besoin">Description des Besoins :</label>
            <textarea name="description_besoin" id="description_besoin" class="form-control">{{ $equipement->description_besoin }}</textarea>
        </div>

        <div class="form-group">
            <label for="groupement_id">Groupement :</label>
            <select name="groupement_id" id="groupement_id" class="form-control" required>
                <option value="">-- Sélectionnez un groupement --</option>
                @foreach($groupements as $groupement)
                    <option value="{{ $groupement->groupement_id }}" {{ $equipement->groupement_id == $groupement->groupement_id ? 'selected' : '' }}>
                        {{ $groupement->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-submit">Mettre à jour</button>
    </form>
</div>

<style>
.containerer {
    max-width: 600px;
    margin: 5rem 0rem 0rem 35rem;
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
    background-color:#9b87f5;
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