
@extends('welcome')

@section('name', 'Créer un Quartier')

@section('content')
<div class="container-form">
    <h1 class="form-title">Créer un Quartier</h1>
    <form action="{{ route('quartier.store') }}" method="POST" class="form-quartier">
        @csrf

        <div class="form-group">
            <label for="arrondissement_id">Arrondissement</label>
            <select id="arrondissement_id" name="arrondissement_id" required>
                <option value="" disabled selected>Choisissez un arrondissement</option>
                @foreach($arrondissements as $arrondissement)
                    <option value="{{ $arrondissement->arrondissement_id }}">{{ $arrondissement->arrondissement_libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nom_quartier">Nom du Quartier</label>
            <input type="text" id="nom_quartier" name="nom_quartier" placeholder="Entrez le nom du quartier" required>
        </div>

        <button type="submit" class="btn-submit">Créer le Quartier</button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 13rem 2rem 0rem 35rem;
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