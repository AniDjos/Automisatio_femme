@extends('welcome')

@section('name', 'Modifier un CPS')

@section('content')
<div class="container-form">
    <h1 class="form-title">
        <i class="fas fa-edit form-title-icon"></i>
        Modifier le CPS
    </h1>
    <form action="{{ route('cps.update', $cps->cps_id) }}" method="POST" class="form-cps">
        @csrf
        @method('PUT')

        <!-- Champ Libellé du CPS -->
        <div class="form-group">
            <label for="cps_libelle">Libellé du CPS</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-file-text input-icon"></i>
                <input type="text" id="cps_libelle" name="cps_libelle" value="{{ $cps->cps_libelle }}"
                    placeholder="Entrez le libellé du CPS" required>
            </div>
        </div>

        <!-- Champ Département -->
        <div class="form-group">
            <label for="departement">Département</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-map-pin input-icon"></i>
                <select id="departement" name="departement" required>
                    <option value="" disabled>Choisissez un département</option>
                    @foreach($departements as $departement)
                    <option value="{{ $departement->departement_id }}"
                        {{ $cps->departement_id == $departement->departement_id ? 'selected' : '' }}>
                        {{ $departement->departement_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid-layout">
            <!-- Champ Commune -->
            <div class="form-group">
                <label for="commune">Commune</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-city input-icon"></i>
                    <select id="commune" name="commune" required>
                        <option value="" disabled>Choisissez une commune</option>
                        @foreach($communes as $commune)
                        <option value="{{ $commune->commune_id }}"
                            {{ $cps->commune_id == $commune->commune_id ? 'selected' : '' }}>
                            {{ $commune->commune_libelle }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Champ Arrondissement -->
            <div class="form-group">
                <label for="arrondissement">Arrondissement</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-map-pin input-icon"></i>
                    <select id="arrondissement" name="arrondissement" required>
                        <option value="" disabled>Choisissez un arrondissement</option>
                        @foreach($arrondissements as $arrondissement)
                        <option value="{{ $arrondissement->arrondissement_id }}"
                            {{ $cps->arrondissement_id == $arrondissement->arrondissement_id ? 'selected' : '' }}>
                            {{ $arrondissement->arrondissement_libelle }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Champ quartier -->
        <div class="form-group">
            <label for="quartier">Quartier</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-map-pin input-icon"></i>
                <select id="quartier" name="quartier" required>
                    <option value="" disabled>Choisissez un quartier</option>
                    @foreach($quartiers as $quartier)
                    <option value="{{ $quartier->quartier_id }}"
                        {{ $cps->quartier_id == $quartier->quartier_id ? 'selected' : '' }}>
                        {{ $quartier->quartier_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save btn-icon"></i>
            Enregistrer les modifications
        </button>
    </form>
</div>

<style>
.container-form {
    max-width: 700px;
    margin: 5rem auto;
    padding: 2.5rem;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(155, 135, 245, 0.15);
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

@media (min-width: 1200px) {
    .container-form {
        margin: 8rem 0rem 2rem 35rem;
    }
}

.container-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(155, 135, 245, 0.2);
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
    font-size: 24px;
}

.grid-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
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
    gap: 10px;
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
    background-color: #fff;
    color: #9b87f5;
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
    
    .grid-layout {
        grid-template-columns: 1fr;
        gap: 0;
    }
}
</style>


<!-- N'oubliez pas d'inclure Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departementSelect = document.getElementById('departement');
    const communeSelect = document.getElementById('commune');
    const arrondissementSelect = document.getElementById('arrondissement');

    // Réinitialiser les options
    function resetSelect(selectElement, placeholder) {
        selectElement.innerHTML = `<option value="" disabled>${placeholder}</option>`;
    }

    // Charger les communes en fonction du département sélectionné
    departementSelect.addEventListener('change', function() {
        const departementId = this.value;

        resetSelect(communeSelect, 'Choisissez une commune');
        resetSelect(arrondissementSelect, 'Choisissez un arrondissement');

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
});
</script>


@endsection