@extends('welcome')

@section('name', 'Modifier une Commune')

@section('content')
<div class="containerer">
    <div class="form-header">
        <h1 class="page-title">Modifier la Commune</h1>
    </div>

    <form action="{{ route('communes.update', $commune->commune_id) }}" method="POST" class="form-edit">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="commune_libelle">Nom de la Commune</label>
            <div class="input-with-icon">
                <i class="icon-location"></i>
                <input type="text" name="commune_libelle" id="commune_libelle" class="form-control" value="{{ $commune->commune_libelle }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="departement_id">Département</label>
            <div class="input-with-icon">
                <i class="icon-map"></i>
                <select name="departement_id" id="departement_id" class="form-control" required>
                    <option value="">-- Sélectionnez un département --</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->departement_id }}" {{ $commune->departement_id == $departement->departement_id ? 'selected' : '' }}>
                            {{ $departement->departement_libelle }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="icon-check"></i>
                <span>Mettre à jour</span>
            </button>
        </div>
    </form>
</div>

<style>
.containerer {
    width: 700px;
    margin: 10rem 1rem 1rem 33rem;
    padding: 2.5rem;
    background: linear-gradient(to bottom right, #ffffff, #f8f9fa);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    font-family: 'Poppins', sans-serif;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.containerer:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(155, 135, 245, 0.2);
}

.form-header {
    margin-bottom: 2.5rem;
    position: relative;
    padding-bottom: 1rem;
    text-align: center;
}

.form-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, #9b87f5, #b8a8f8);
    border-radius: 10px;
}

.page-title {
    font-size: 1.9rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #9b87f5;
    letter-spacing: 0.5px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.form-edit {
    display: grid;
    grid-gap: 1.75rem;
}

.form-group {
    position: relative;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.75rem;
    color: #444;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.input-with-icon {
    position: relative;
}

.input-with-icon .icon-location,
.input-with-icon .icon-map,
.btn-submit .icon-check {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9b87f5;
    font-size: 1.2rem;
}

.input-with-icon .icon-location::before {
    content: "🏙️";
}

.input-with-icon .icon-map::before {
    content: "🗺️";
}

.btn-submit .icon-check::before {
    content: "✓";
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 1.1rem 1.25rem 1.1rem 3rem;
    font-size: 0.95rem;
    background-color: #ffffff;
    border: 1px solid rgba(155, 155, 155, 0.2);
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) inset;
}

.form-control:focus {
    border-color: #9b87f5;
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
}

.form-group:focus-within label {
    color: #9b87f5;
    font-weight: 600;
}

.form-actions {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 180px;
    padding: 1rem 1.5rem 1rem 2.5rem;
    font-size: 1rem;
    font-weight: 500;
    color: white;
    background: linear-gradient(45deg, #9b87f5, #ad9bf7);
    border: none;
    border-radius: 12px;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(155, 135, 245, 0.3);
    position: relative;
}

.btn-submit span {
    margin-left: 0.5rem;
}

.btn-submit:hover {
    background: white;
    color: #9b87f5;
    border: 1px solid #9b87f5;
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(155, 135, 245, 0.4);
}

.btn-submit:hover .icon-check {
    color: #9b87f5;
}

.btn-submit:active {
    transform: translateY(1px);
    box-shadow: 0 2px 8px rgba(155, 135, 245, 0.4);
}

@media (max-width: 768px) {
    .containerer {
        width: 95%;
        padding: 1.5rem;
        margin: 3rem auto;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .form-control {
        padding: 0.8rem 1rem 0.8rem 2.5rem;
    }
    
    .btn-submit {
        min-width: 160px;
        padding: 0.8rem 1.2rem 0.8rem 2.2rem;
    }
}

@media (max-width: 480px) {
    .containerer {
        width: 98%;
        padding: 1.25rem;
        margin: 2rem auto;
    }
}
</style>
@endsection
