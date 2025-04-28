@extends('welcome')

@section('name', 'Création d\'un Membre')

@section('content')
<style>
    .container-print {
        width: 81%;
        margin: 5rem 2rem 5rem 17rem;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container-print h1 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .form-membre {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #9b87f5;
        outline: none;
    }

    
    .btn-submit {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background-color: #9b87f5;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        color: #9b87f5;
        background-color: #fff;
        border: 1px solid #9b87f5;
    }


</style>

<div class="container-print">
    <h1 class="">Créer un Membre</h1>
    <form action="{{ route('membres.store') }}" method="POST" class="form-membre">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du Membre</label>
            <input type="text" id="nom" name="nom_membre" placeholder="Entrez le nom du membre" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom du Membre</label>
            <input type="text" id="prenom" name="prenom_membre" placeholder="Entrez le prénom du membre" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role_stimule" required>
                <option value="" disabled selected>Choisissez un rôle</option>
                <option value="Présidente">Présidente</option>
                <option value="Secrétaire">Secrétaire</option>
                <option value="Personnel simple">Membre</option>
                <option value="Personnel simple">Trésorière</option>
            </select>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Entrez le numéro de téléphone" required>
        </div>

        <div class="form-group">
            <label for="groupement_id">Groupement</label>
            <select id="groupement_id" name="groupement_id" required>
                <option value="" disabled selected>Choisissez un groupement</option>
                @foreach($groupements as $groupement)
                    <option value="{{ $groupement->groupement_id }}">{{ $groupement->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Créer le Membre</button>
        </div>
    </form>
</div>
@endsection