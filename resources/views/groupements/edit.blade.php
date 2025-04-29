@extends('welcome')

@section('name', 'Modifier un Groupement')

@section('content')
<style>
    .container-print {
        width: 1200px;
        margin: 6rem 1rem 1rem 17rem;
        padding: 3rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .container-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(155, 135, 245, 0.15);
    }

    /* Progress Bar Styling */
    .progress-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        padding: 0 1rem;
        position: relative;
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 4px;
        background-color: #E5DEFF;
        z-index: 1;
    }

    .progress-bar .step {
        width: 25%;
        text-align: center;
        position: relative;
        z-index: 2;
        font-size: 0.95rem;
        font-weight: 500;
        color: #8A898C;
        transition: all 0.3s ease;
        padding-top: 2rem;
    }

    .progress-bar .step::before {
        content: '';
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        margin: 0 auto 0.8rem;
        background-color: #F6F6F7;
        border: 3px solid #E5DEFF;
        border-radius: 50%;
        transition: all 0.4s ease;
        position: absolute;
        top: -42px;
        left: calc(50% - 17px);
        z-index: 3;
    }

    .progress-bar .step.active {
        color: #1A1F2C;
        font-weight: 600;
    }

    .progress-bar .step.active::before {
        background-color: #9b87f5;
        border-color: #E5DEFF;
        box-shadow: 0 0 0 6px rgba(155, 135, 245, 0.2);
    }

    /* Form Steps Styling */
    .form-step {
        display: none;
        animation: fadeIn 0.5s ease forwards;
        margin-top: 1rem;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .form-step.active {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .form-step h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #1A1F2C;
        text-align: left;
        grid-column: 1 / -1;
        font-weight: 600;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.2rem;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.6rem;
        color: #403E43;
        font-size: 0.95rem;
        letter-spacing: 0.02rem;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea {
        padding: 0.8rem 1rem;
        border: 1px solid #E5DEFF;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #F6F6F7;
        transition: all 0.25s ease;
    }

    .form-group input[type="file"] {
        padding: 0.6rem;
        background-color: #F6F6F7;
        border: 1px dashed #9b87f5;
        border-radius: 8px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
        box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
        background-color: #ffffff;
    }

    .form-group input::placeholder {
        color: #8A898C;
        opacity: 0.7;
    }

    .form-group input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #9b87f5;
    }

    /* Checkbox container */
    .form-group:has(input[type="checkbox"]) {
        flex-direction: row;
        align-items: center;
        gap: 0.8rem;
    }

    #appui-details {
        background-color: #F9F8FF;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #9b87f5;
        margin: 1rem 0;
        grid-column: 1 / -1;
    }

    /* Button Styling */
    .btn-container {
        grid-column: 1 / -1;
        display: flex;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }

    .btn-next,
    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.8rem 2rem;
        font-size: 1rem;
        font-weight: 500;
        color: #fff;
        background-color: #9b87f5;
        border: 2px solid #9b87f5;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-next:hover,
    .btn-submit:hover {
        background-color: #7E69AB;
        border-color: #7E69AB;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(155, 135, 245, 0.3);
    }

    .btn-next:active,
    .btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(155, 135, 245, 0.3);
    }

    .error {
        border-color: #ff5a5a !important;
        box-shadow: 0 0 0 3px rgba(255, 90, 90, 0.2) !important;
    }

    .error-message {
        color: #ff5a5a;
        font-size: 0.85rem;
        margin-top: 0.4rem;
    }

    @media (max-width: 768px) {
        .container-print {
            width: 95%;
            margin: 2rem auto;
            padding: 1.5rem;
        }
        
        .form-step.active {
            grid-template-columns: 1fr;
        }
        
        .progress-bar .step {
            font-size: 0.75rem;
        }
    }
</style>

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
            <h2>Informations générales</h2>
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
            <div class="btn-container">
                <button type="button" class="btn-next">Suivant</button>
            </div>
        </div>

        <!-- Étape 2 -->
        <div class="form-step">
            <h2>Activités et Finances</h2>
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
            <div class="btn-container">
                <button type="button" class="btn-next">Suivant</button>
            </div>
        </div>

        <!-- Étape 3 -->
        <div class="form-step">
            <h2>Appui et Soutien</h2>
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
            <div class="btn-container">
                <button type="button" class="btn-next">Suivant</button>
            </div>
        </div>

        <!-- Étape 4 -->
        <div class="form-step">
            <h2>Équipement et Documentation</h2>
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
            <div class="btn-container">
                <button type="submit" class="btn-submit">Valider les modifications</button>
            </div>
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
@endsection
