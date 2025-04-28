@extends('welcome')

@section('name', 'Modifier une Commune')

@section('content')
<div class="containerer">
    <h1 class="page-title">Modifier la Commune</h1>

    <form action="{{ route('communes.update', $commune->commune_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="commune_libelle">Nom de la Commune :</label>
            <input type="text" name="commune_libelle" id="commune_libelle" class="form-control" value="{{ $commune->commune_libelle }}" required>
        </div>

        <div class="form-group">
            <label for="departement_id">Département :</label>
            <select name="departement_id" id="departement_id" class="form-control" required>
                <option value="">-- Sélectionnez un département --</option>
                @foreach($departements as $departement)
                    <option value="{{ $departement->departement_id }}" {{ $commune->departement_id == $departement->departement_id ? 'selected' : '' }}>
                        {{ $departement->departement_libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-submit">Mettre à jour</button>
    </form>
</div>

<style>
.containerer {
    width: 700px;
    margin: 13rem 0rem 0rem 35rem;
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
    color:  #9b87f5;
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
    background-color:  #9b87f5;
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