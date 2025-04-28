@extends('welcome')

@section('name', 'Modifier un CPS')

@section('content')
<div class="container-form">
    <h1 class="form-title">Modifier le CPS</h1>
    <form action="{{ route('cps.update', $cps->cps_id) }}" method="POST" class="form-cps">
        @csrf
        @method('PUT')

        <!-- Champ Libellé du CPS -->
        <div class="form-group">
            <label for="cps_libelle">Libellé du CPS</label>
            <input type="text" id="cps_libelle" name="cps_libelle" value="{{ $cps->cps_libelle }}"
                placeholder="Entrez le libellé du CPS" required>
        </div>

        <!-- Champ Département -->
        <div class="form-group">
            <label for="departement">Département</label>
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

        <!-- Champ Commune -->
        <div class="form-group">
            <label for="commune">Commune</label>
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

        <!-- Champ Arrondissement -->
        <div class="form-group">
            <label for="arrondissement">Arrondissement</label>
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

        <!-- Champ quartier -->
        <div class="form-group">
            <label for="quartier">Quartier</label>
            <select id="quartier" name="quartier" required>
                <option value="" disabled>Choisissez un arrondissement</option>
                @foreach($quartiers as $quartier)
                <option value="{{ $quartier->quartier_id }}"
                    {{ $cps->quartier_id == $quartier->quartier_id ? 'selected' : '' }}>
                    {{ $quartier->quartier_libelle }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-submit">Enregistrer les modifications</button>
    </form>
</div>

<style>
/* Styles existants */
</style>

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


<style>
.container-form {
    max-width: 600px;
    margin: 10rem 0rem 2rem 35rem;
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

.form-group input {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
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