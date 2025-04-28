@extends('welcome')

@section('name', 'Modifier un Groupement')

@section('content')
<div class="container-print">
    <div class="progress-bar">
        <div class="step active">Étape 1</div>
        <div class="step">Étape 2</div>
        <div class="step">Étape 3</div>
        <div class="step">Étape 4</div>
    </div>
    <form id="multi-step-form" action="{{ route('groupements.update', $groupement->groupement_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Étape 1 -->
        <div class="form-step active">
            <div class="form-group">
                <label for="nom">Nom du Groupement</label>
                <input type="text" id="nom" name="nom" value="{{ $groupement->nom }}" required>
            </div>
            <div class="form-group">
                <label for="date_creation">Date de Création</label>
                <input type="date" id="date_creation" name="date_creation" value="{{ $groupement->date_creation }}"
                    required>
            </div>
            <div class="form-group">
                <label for="departement">Département</label>
                <select id="departement" name="departement" required>
                    @foreach($departements as $departement)
                    <option value="{{ $departement->departement_id }}"
                        {{ $groupement->departement_id == $departement->departement_id ? 'selected' : '' }}>
                        {{ $departement->departement_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="commune">Commune</label>
                <select id="commune" name="commune" required>
                    @foreach($communes as $commune)
                    <option value="{{ $commune->commune_id }}"
                        {{ $groupement->commune_id == $commune->commune_id ? 'selected' : '' }}>
                        {{ $commune->commune_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="arrondissement">Arrondissement</label>
                <select id="arrondissement" name="arrondissement" required>
                    @foreach($arrondissements as $arrondissement)
                    <option value="{{ $arrondissement->arrondissement_id }}"
                        {{ $groupement->arrondissement_id == $arrondissement->arrondissement_id ? 'selected' : '' }}>
                        {{ $arrondissement->arrondissement_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quartier">Quartier</label>
                <select id="quartier" name="quartier">
                    @foreach($quartiers as $quartier)
                    <option value="{{ $quartier->quartier_id }}"
                        {{ $groupement->quartier_id == $quartier->quartier_id ? 'selected' : '' }}>
                        {{ $quartier->quartier_libelle }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 2 -->
        <div class="form-step">
            <div class="form-group">
                <label for="activite_principale">Activité Principale</label>
                <select id="activite_principale" name="activite_principale" required>
                    @foreach($activites as $activite)
                    <option value="{{ $activite->activite_id }}"
                        {{ $groupement->activite_principale_id == $activite->activite_id ? 'selected' : '' }}>
                        {{ $activite->activite }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="activite_secondaire">Activité Secondaire</label>
                <select id="activite_secondaire" name="activite_secondaire">
                    <option value="">Aucune</option>
                    @foreach($activites as $activite)
                    <option value="{{ $activite->activite_id }}"
                        {{ $groupement->activite_secondaire_id == $activite->activite_id ? 'selected' : '' }}>
                        {{ $activite->activite }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="filiere">Filière</label>
                <select id="filiere" name="filiere" required>
                    @foreach($filieres as $filiere)
                    <option value="{{ $filiere->filiere_id }}"
                        {{ $groupement->filiere_id == $filiere->filiere_id ? 'selected' : '' }}>
                        {{ $filiere->filiere_nom }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="effectif">Effectif</label>
                <input type="number" id="effectif" name="effectif" value="{{ $groupement->effectif }}" min="1" required>
            </div>
            <div class="form-group">
                <label for="revenu">Revenu mensuel</label>
                <input type="number" id="revenu" name="revenu" value="{{ $groupement->revenu_mens }}" min="0"
                    step="0.01" required>
            </div>
            <div class="form-group">
                <label for="depense">Dépense mensuelle</label>
                <input type="number" id="depense" name="depense" value="{{ $groupement->depense_mens }}" min="0"
                    step="0.01" required>
            </div>
            <div class="form-group">
                <label for="benefice">Bénéfice mensuel</label>
                <input type="number" id="benefice" name="benefice" value="{{ $groupement->benefice_mens }}" min="0"
                    step="0.01" required>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 3 -->
        <div class="form-step">
            <div class="form-group">
                <label>Bénéficiez-vous d'un appui ?</label>
                <input type="checkbox" id="appui" name="appui" value="1" {{ $groupement->appui ? 'checked' : '' }}>
            </div>
            <div id="appui-details" style="{{ $groupement->appui ? '' : 'display: none;' }}">
                <div class="form-group">
                    <label for="type_appui">Type d'Appui</label>
                    <select id="type_appui" name="type_appui">
                        <option value="" disabled>Choisissez un type d'appui</option>
                        <option value="financier" {{ $groupement->type_appui == 'financier' ? 'selected' : '' }}>Financier</option>
                        <option value="materiel" {{ $groupement->type_appui == 'materiel' ? 'selected' : '' }}>Matériel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="structure_appui">Structure Responsable</label>
                    <select id="structure_appui" name="structure">
                        <option value="" disabled>Choisissez une structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->structure_id }}" {{ $groupement->structure_id == $structure->structure_id ? 'selected' : '' }}>
                                {{ $structure->structure }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description_appui">Description de l'Appui</label>
                    <textarea id="description_appui" name="description_appui" rows="4">{{ $groupement->description_appui }}</textarea>
                </div>
                <div class="form-group">
                    <label for="annee_appui">Année d'Appui</label>
                    <input type="date" id="annee_appui" name="annee_appui" value="{{ $groupement->annee_appui }}">
                </div>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 4 -->
        <div class="form-step">
            <div class="form-group">
                <label for="equipement">Équipement</label>
                <input type="text" id="equipement" name="equipement" value="{{ $groupement->equipement }}" required>
            </div>
            <div class="form-group">
                <label for="etat_equipement">État de l'Équipement</label>
                <select id="etat_equipement" name="etat_equipement" required>
                    <option value="" disabled>Choisissez l'état</option>
                    <option value="neuf" {{ $groupement->etat_equipement == 'neuf' ? 'selected' : '' }}>Neuf</option>
                    <option value="use" {{ $groupement->etat_equipement == 'use' ? 'selected' : '' }}>Usé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description_difficulte">Difficulté</label>
                <textarea id="description_difficulte" name="description_difficulte" rows="4">{{ $groupement->description_difficulte }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_besoin">Besoins</label>
                <textarea id="description_besoin" name="description_besoin" rows="4">{{ $groupement->description_besoin }}</textarea>
            </div>
            <div class="form-group">
                <label for="structure_delivrance">Structure Responsable</label>
                <select id="structure_delivrance" name="structure_delivrance">
                    <option value="" disabled>Choisissez une structure</option>
                    @foreach($structures as $structure)
                        <option value="{{ $structure->structure_id }}" {{ $groupement->structure_delivrance == $structure->structure_id ? 'selected' : '' }}>
                            {{ $structure->structure }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reference">Référence de l'agrément</label>
                <input type="text" id="reference" name="reference" value="{{ $groupement->reference }}" required>
            </div>
            <div class="form-group">
                <label for="agrement">Agrément (Fichier)</label>
                <input type="file" id="agrement" name="agrement" accept=".pdf,.doc,.docx,.jpg,.png">
            </div>
            <div class="form-group">
                <label for="annee_delivrance">Année de Délivrance</label>
                <input type="date" id="annee_delivrance" name="annee_delivrance" value="{{ $groupement->annee_delivrance }}" required>
            </div>
            <button type="submit" class="btn-submit">Valider les modifications</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.form-step');
        const nextButtons = document.querySelectorAll('.btn-next');
        const progressSteps = document.querySelectorAll('.progress-bar .step');

        let currentStep = 0;

        // Fonction pour afficher l'étape actuelle
        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === stepIndex);
            });

            progressSteps.forEach((progressStep, index) => {
                progressStep.classList.toggle('active', index <= stepIndex);
            });
        }

        // Gestion des boutons "Suivant"
        nextButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
        });

        // Afficher la première étape au chargement
        showStep(currentStep);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appuiCheckbox = document.getElementById('appui');
        const appuiDetails = document.getElementById('appui-details');

        appuiCheckbox.addEventListener('change', function () {
            if (appuiCheckbox.checked) {
                appuiDetails.style.display = 'block';
            } else {
                appuiDetails.style.display = 'none';
                // Réinitialiser les champs d'appui
                appuiDetails.querySelectorAll('input, select, textarea').forEach(field => field.value = '');
            }
        });
    });
</script>

<style>
    .container-print {
        width: 81%;
        margin: 5rem 2rem 5rem 17rem;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-step h2 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
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

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
    }

    .btn-next,
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

    .btn-next:hover,
    .btn-submit:hover {
        color: #9b87f5;
        background-color: #fff;
        border: 1px solid #9b87f5;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .progress-bar .step {
        width: 25%;
        text-align: center;
        position: relative;
    }

    .progress-bar .step::before {
        content: '';
        display: block;
        width: 20px;
        height: 20px;
        margin: 0 auto;
        background-color: #ddd;
        border-radius: 50%;
        transition: background-color 0.3s ease;
    }

    .progress-bar .step.active::before {
        background-color: #9b87f5;
    }

    .progress-bar .step::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 2px;
        background-color: #9b87f5;
        z-index: -1;
        transform: translate(-50%, -50%);
    }

    .progress-bar .step:last-child::after {
        display: none;
    }

    .progress-bar .step.active + .step::after {
        background-color: #9b87f5;
    }

    .error {
        border-color: #ff0000 !important;
    }
</style>
@endsection