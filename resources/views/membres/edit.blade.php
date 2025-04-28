@extends('welcome')

@section('name', 'Modifier un Membre')

@section('content')
<div class="container-forme">
    <h1 class="form-title">Modifier les informations du membre</h1>
    <form action="{{ route('membres.update', $membre->membre_id) }}" method="POST" class="form-membre">
        @csrf
        @method('PUT')

        <input type="hidden" name="groupement_id" value="{{ $membre->groupement_id }}">

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ $membre->nom_membre }}" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ $membre->prenom_membre }}" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <input type="text" id="role" name="role" value="{{ $membre->role_stimule }}" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ $membre->telephone }}">
        </div>

        <button type="submit" class="btn-submit">Enregistrer les modifications</button>
    </form>
</div>
<style>
.container-forme {
    max-width: 1200px;
    margin: 7rem 2rem 2rem 17rem;
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

.form-group input {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #9b87f5;
    outline: none;
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