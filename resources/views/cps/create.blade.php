@extends('welcome')

@section('name', 'Créer un CPS')

@section('content')

<div class="container-form">
    <h1 class="form-title">
        <i class="fas fa-building form-title-icon"></i>
        Créer un CPS
    </h1>
    <form action="{{ route('cps.store') }}" method="POST" class="form-cps">
        @csrf

        <!-- Champ Département -->
        <div class="form-group">
            <label for="departement">Département</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-map-marker-alt input-icon"></i>
                <select id="departement" name="departement" required>
                    <option value="" disabled selected>Choisissez un département</option>
                    @foreach($departements as $departement)
                    <option value="{{ $departement->departement_id }}">{{ $departement->departement_libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Champ Commune -->
        <div class="form-group">
            <label for="commune">Commune</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-city input-icon"></i>
                <select id="commune" name="commune" required>
                    <option value="" disabled selected>Choisissez une commune</option>
                </select>
            </div>
        </div>

        <!-- Champ Arrondissement -->
        <div class="form-group">
            <label for="arrondissement">Arrondissement</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-map-marked-alt input-icon"></i>
                <select id="arrondissement" name="arrondissement" required>
                    <option value="" disabled selected>Choisissez un arrondissement</option>
                </select>
            </div>
        </div>

        <!-- Champ Quartier -->
        <div class="form-group">
            <label for="quartier">Quartier</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-home input-icon"></i>
                <select id="quartier" name="quartier" required>
                    <option value="" disabled selected>Choisissez un quartier</option>
                </select>
            </div>
        </div>

        <!-- Champ Libellé du CPS -->
        <div class="form-group">
            <label for="cps_libelle">Libellé du CPS</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-file-alt input-icon"></i>
                <input type="text" id="cps_libelle" name="cps_libelle" placeholder="Entrez le libellé du CPS" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-plus-circle btn-icon"></i>
            Créer le CPS
        </button>
    </form>
</div>

<style>
.container-form {
    max-width: 600px;
    margin: 4.5rem auto;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

@media (min-width: 1200px) {
    .container-form {
        margin: 4.5rem 0rem 2rem 35rem;
    }
}

.container-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(155, 135, 245, 0.15);
}

.form-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
    color: #7E69AB;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-bottom: 1rem;
    border-bottom: 2px solid #E5DEFF;
}

.form-title-icon {
    margin-right: 12px;
    color: #9b87f5;
}

.form-cps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group {
    margin-bottom: 1rem;
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
    gap: 8px;
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

.btn-icon {
    font-size: 18px;
}

.btn-submit:hover {
    color: #9b87f5;
    background-color: #fff;
    border-color: #9b87f5;
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



<!-- Inclure Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<script>
document.addEventListener('DOMContentLoaded', function() {
    const departementSelect = document.getElementById('departement');
    const communeSelect = document.getElementById('commune');
    const arrondissementSelect = document.getElementById('arrondissement');
    const quartierSelect = document.getElementById('quartier');

    // Réinitialiser les options
    function resetSelect(selectElement, placeholder) {
        selectElement.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
    }

    // Charger les communes en fonction du département sélectionné
    departementSelect.addEventListener('change', function() {
        const departementId = this.value;

        resetSelect(communeSelect, 'Choisissez une commune');
        resetSelect(arrondissementSelect, 'Choisissez un arrondissement');
        resetSelect(quartierSelect, 'Choisissez un quartier');

        if (departementId) {
            fetch(`/api/communes/${departementId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(commune => {
                        const option = document.createElement('option');
                        option.value = commune.commune_id;
                        option.textContent = commune.commune_libelle;
                        communeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des communes:', error));
        }
    });

    // Charger les arrondissements en fonction de la commune sélectionnée
    communeSelect.addEventListener('change', function() {
        const communeId = this.value;

        resetSelect(arrondissementSelect, 'Choisissez un arrondissement');
        resetSelect(quartierSelect, 'Choisissez un quartier');

        if (communeId) {
            fetch(`/api/arrondissements/${communeId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(arrondissement => {
                        const option = document.createElement('option');
                        option.value = arrondissement.arrondissement_id;
                        option.textContent = arrondissement.arrondissement_libelle;
                        arrondissementSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des arrondissements:', error));
        }
    });

    // Charger les quartiers en fonction de l'arrondissement sélectionné
    arrondissementSelect.addEventListener('change', function() {
        const arrondissementId = this.value;

        resetSelect(quartierSelect, 'Choisissez un quartier');

        if (arrondissementId) {
            fetch(`/api/quartiers/${arrondissementId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(quartier => {
                        const option = document.createElement('option');
                        option.value = quartier.quartier_id;
                        option.textContent = quartier.quartier_libelle;
                        quartierSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des quartiers:', error));
        }
    });
});
</script>

@endsection