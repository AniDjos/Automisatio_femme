@extends('welcome')

@section('name', 'Créer un Quartier')

@section('content')
<div class="container-form">
    <h1 class="form-title">Créer un Quartier</h1>
    <form action="{{ route('quartier.store') }}" method="POST" class="form-quartier">
        @csrf

        <div class="form-group">
            <label for="arrondissement_id">Arrondissement</label>
            <div class="input-icon-wrapper">
                <i class="input-icon fas fa-map-marker-alt"></i>
                <select id="arrondissement_id" name="arrondissement_id" required>
                    <option value="" disabled selected>Choisissez un arrondissement</option>
                    @foreach($arrondissements as $arrondissement)
                        <option value="{{ $arrondissement->arrondissement_id }}">{{ $arrondissement->arrondissement_libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="nom_quartier">Nom du Quartier</label>
            <div class="input-icon-wrapper">
                <i class="input-icon fas fa-home"></i>
                <input type="text" id="nom_quartier" name="nom_quartier" placeholder="Entrez le nom du quartier" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i>
            Créer le Quartier
        </button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 5rem auto;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

@media (min-width: 1024px) {
    .container-form {
        margin: 13rem 2rem 0rem 35rem;
    }
}

.container-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(155, 135, 245, 0.2);
}

.form-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
    color: #7E69AB;
    padding-bottom: 1rem;
    border-bottom: 2px solid #E5DEFF;
}

.form-quartier {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 0.5rem;
}

.form-group label {
    display: block;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 0.6rem;
    color: #403E43;
    letter-spacing: 0.02rem;
}

.input-icon-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 12px;
    color: #9b87f5;
    font-size: 16px;
    z-index: 1;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.9rem 1rem 0.9rem 2.5rem;
    font-size: 15px;
    border: 1px solid #E5DEFF;
    border-radius: 8px;
    box-sizing: border-box;
    transition: all 0.3s ease;
    background-color: #F6F6F7;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #9b87f5;
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
    background-color: #ffffff;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 1rem;
    font-size: 16px;
    font-weight: 600;
    color: white;
    background-color: #9b87f5;
    border: 2px solid #9b87f5;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 1rem;
}

.btn-submit:hover {
    background-color: #fff;
    color: #9b87f5;
    border: 2px solid #9b87f5;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 5px rgba(155, 135, 245, 0.3);
}

@media (max-width: 768px) {
    .container-form {
        margin: 2rem 1rem;
        padding: 1.5rem;
    }
}
</style>

<!-- N'oubliez pas d'inclure Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
