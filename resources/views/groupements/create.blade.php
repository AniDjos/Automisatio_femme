@extends('welcome')

@section('name', 'Groupement > create')

@section('content')
<div class="container-print">
    <div class="progress-bar">
        <div class="step active">Étape 1</div>
        <div class="step">Étape 2</div>
        <div class="step">Étape 3</div>
        <div class="step">Étape 4</div>
    </div>
    <form id="multi-step-form" action="{{ route('groupements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Étape 1 -->
        <div class="form-step active">
            <div class="form-group">
                <label for="nom">Nom du Groupement</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez le nom du groupement" required>
            </div>
            <div class="form-group">
                <label for="date_creation">Date de Création</label>
                <input type="date" id="date_creation" name="date_creation" required>
            </div>
            <div class="form-group">
                <label for="departement">Département</label>
                <select id="departement" name="departement" required>
                    <option value="" disabled selected>Choisissez un département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->departement_id }}">{{ $departement->departement_libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="commune">Commune</label>
                <select id="commune" name="commune" required>
                    <option value="" disabled selected>Choisissez une commune</option>
                </select>
            </div>
            <div class="form-group">
                <label for="arrondissement">Arrondissement</label>
                <select id="arrondissement" name="arrondissement" required>
                    <option value="" disabled selected>Choisissez un arrondissement</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quartier">Quartier</label>
                <select id="quartier" name="quartier">
                    <option value="" disabled selected>Choisissez un quartier</option>
                </select>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 2 -->
        <div class="form-step">
            <div class="form-group">
                <label for="activite_principale">Activité Principale</label>
                <select id="activite_principale" name="activite_principale" required>
                    <option value="" disabled selected>Choisissez une activité principale</option>
                    @foreach($activites as $activite)
                        <option value="{{ $activite->activite_id }}">{{ $activite->activite }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="activite_secondaire">Activité Secondaire</label>
                <select id="activite_secondaire" name="activite_secondaire">
                    <option value="" disabled selected>Choisissez une activité secondaire</option>
                    @foreach($activites as $activite)
                        <option value="{{ $activite->activite_id }}">{{ $activite->activite }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="filiere">Filière</label>
                <select id="filiere" name="filiere" required>
                    <option value="" disabled selected>Choisissez une filière</option>
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->filiere_id }}">{{ $filiere->filiere_nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="effectif">Effectif</label>
                <input type="number" id="effectif" name="effectif" placeholder="Entrez l'effectif" min="1" required>
            </div>
            <div class="form-group">
                <label for="revenu">Revenu mensuel</label>
                <input type="number" id="revenu" name="revenu" placeholder="Entrez votre revenu mensuel" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="depense">Dépense mensuelle</label>
                <input type="number" id="depense" name="depense" placeholder="Entrez votre dépense mensuelle" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="benefice">Bénéfice mensuel</label>
                <input type="number" id="benefice" name="benefice" placeholder="Entrez votre bénéfice mensuel" min="0" step="0.01" required>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 3 -->
        <div class="form-step">
            <div class="form-group">
                <label>Bénéficiez-vous d'un appui ?</label>
                <input type="checkbox" id="appui"  value="1">
            </div>
            <div id="appui-details" style="display: none;">
                <div class="form-group">
                    <label for="type_appui">Type d'Appui</label>
                    <select id="type_appui" name="type_appui">
                        <option value="" disabled selected>Choisissez un type d'appui</option>
                        <option value="financier">Financier</option>
                        <option value="materiel">Matériel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="structure_appui">Structure Responsable</label>
                    <select id="structure_appui" name="structure">
                        <option value="" disabled selected>Choisissez une structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description_appui">Description de l'Appui</label>
                    <textarea id="description_appui" name="description_appui" placeholder="Entrez une description de l'appui" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="annee_appui">Année d'Appui</label>
                    <input type="date" id="annee_appui" name="annee_appui">
                </div>
            </div>
            <button type="button" class="btn-next">Suivant</button>
        </div>

        <!-- Étape 4 -->
        <div class="form-step">
            <div class="form-group">
                <label for="equipement">Équipement</label>
                <input type="text" id="equipement" name="equipement" placeholder="Entrez l'équipement" required>
            </div>
            <div class="form-group">
                <label for="etat_equipement">État de l'Équipement</label>
                <select id="etat_equipement" name="etat_equipement" required>
                    <option value="" disabled selected>Choisissez l'état</option>
                    <option value="neuf">Neuf</option>
                    <option value="use">Usé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description_difficulte">Difficulté</label>
                <textarea id="description_difficulte" name="description_difficulte" placeholder="Décrivez les difficultés rencontrées" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="description_besoin">Besoins</label>
                <textarea id="description_besoin" name="description_besoin" placeholder="Décrivez vos besoins" rows="4"></textarea>
            </div>
            <div class="form-group">
                    <label for="structure_appui">Structure Responsable</label>
                    <select id="structure_delivrance" name="structure_delivrance">
                        <option value="" disabled selected>Choisissez une structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="reference">Référence de l'agrément</label>
                <input type="text" id="reference" name="reference" placeholder="Entrez la référence" required>
            </div>
            <div class="form-group">
                <label for="agrement">Agrément (Fichier)</label>
                <input type="file" id="agrement" name="agrement" multiple accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <div class="form-group">
                <label for="annee_delivrance">Année de Délivrance</label>
                <input type="date" id="annee_delivrance" name="annee_delivrance" required>
            </div>
            <button type="submit" class="btn-submit">Valider</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let currentStep = 0;
        const steps = $('.form-step');
        const progressSteps = $('.progress-bar .step');

        // Afficher uniquement la première étape
        steps.hide();
        steps.eq(currentStep).show();

        // Mettre à jour la barre de progression
        function updateProgressBar() {
            progressSteps.removeClass('active');
            progressSteps.eq(currentStep).addClass('active');
        }

        // Gestion du bouton "Suivant"
        $('.btn-next').on('click', function () {
            // Valider les champs obligatoires de l'étape courante avant de continuer
            let isValid = true;
            steps.eq(currentStep).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error');
                    alert('Veuillez remplir tous les champs obligatoires');
                    return false; // Sortir de la boucle each
                }
            });

            if (isValid && currentStep < steps.length - 1) {
                steps.eq(currentStep).removeClass('active').hide();
                currentStep++;
                steps.eq(currentStep).addClass('active').show();
                updateProgressBar();
            }
        });

        // Initialiser la barre de progression
        updateProgressBar();

        // Charger les communes en fonction du département sélectionné
        $('#departement').on('change', function () {
            let departementId = $(this).val();
            $('#commune').html('<option value="" disabled selected>Chargement...</option>');
            $('#arrondissement').html('<option value="" disabled selected>Choisissez un arrondissement</option>');
            $('#quartier').html('<option value="" disabled selected>Choisissez un quartier</option>');

            if (departementId) {
                $.ajax({
                    url: "{{ route('get.communes') }}",
                    type: "POST",
                    data: {
                        departement_id: departementId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        $('#commune').html('<option value="" disabled selected>Choisissez une commune</option>');
                        $.each(data, function (key, commune) {
                            $('#commune').append('<option value="' + commune.commune_id + '">' + commune.commune_libelle + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Erreur lors du chargement des communes :', error);
                    }
                });
            }
        });

        // Charger les arrondissements en fonction de la commune sélectionnée
        $('#commune').on('change', function () {
            let communeId = $(this).val();
            $('#arrondissement').html('<option value="" disabled selected>Chargement...</option>');
            $('#quartier').html('<option value="" disabled selected>Choisissez un quartier</option>');

            if (communeId) {
                $.ajax({
                    url: "{{ route('get.arrondissements') }}",
                    type: "POST",
                    data: {
                        commune_id: communeId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        $('#arrondissement').html('<option value="" disabled selected>Choisissez un arrondissement</option>');
                        $.each(data, function (key, arrondissement) {
                            $('#arrondissement').append('<option value="' + arrondissement.arrondissement_id + '">' + arrondissement.arrondissement_libelle + '</option>');
                        });
                    }
                });
            }
        });

        // Charger les quartiers en fonction de l'arrondissement sélectionné
        $('#arrondissement').on('change', function () {
            let arrondissementId = $(this).val();
            $('#quartier').html('<option value="" disabled selected>Chargement...</option>');

            if (arrondissementId) {
                $.ajax({
                    url: "{{ route('get.quartiers') }}",
                    type: "POST",
                    data: {
                        arrondissement_id: arrondissementId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        $('#quartier').html('<option value="" disabled selected>Choisissez un quartier</option>');
                        $.each(data, function (key, quartier) {
                            $('#quartier').append('<option value="' + quartier.quartier_id + '">' + quartier.quartier_libelle + '</option>');
                        });
                    }
                });
            }
        });

        // Gestion de l'affichage des détails d'appui
        $('#appui').on('change', function () {
            if ($(this).is(':checked')) {
                $('#appui-details').slideDown();
            } else {
                $('#appui-details').slideUp();
                // Réinitialiser les champs d'appui
                $('#appui-details').find('input, select, textarea').val('');
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