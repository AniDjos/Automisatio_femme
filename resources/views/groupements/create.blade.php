@extends('welcome')

@section('name', 'Groupement')

@section('content')
<div class="container-print">
    <div class="progress-container">
        <div class="progress-bar">
            <div class="step active">
                <div class="step-icon">1</div>
                <div class="step-text">Informations</div>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <div class="step-text">Activités</div>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <div class="step-text">Appuis</div>
            </div>
            <div class="step">
                <div class="step-icon">4</div>
                <div class="step-text">Équipements</div>
            </div>
        </div>
    </div>

    <form id="multi-step-form" action="{{ route('groupements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Étape 1 -->
        <div class="form-step active">
            <h2 class="step-title">Informations générales</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom du Groupement</label>
                    <div class="input-wrapper">
                        <i class="bx bx-group input-icon"></i>
                        <input type="text" id="nom" name="nom" placeholder="Entrez le nom du groupement" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="date_creation">Date de Création</label>
                    <div class="input-wrapper">
                        <i class="bx bx-calendar input-icon"></i>
                        <input type="date" id="date_creation" name="date_creation" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="departement">Département</label>
                <div class="input-wrapper">
                    <i class="bx bx-map input-icon"></i>
                    <select id="departement" name="departement" required>
                        <option value="" disabled selected>Choisissez un département</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->departement_id }}">{{ $departement->departement_libelle }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="location-grid">
                <div class="form-group">
                    <label for="commune">Commune</label>
                    <div class="input-wrapper">
                        <i class="bx bx-building input-icon"></i>
                        <select id="commune" name="commune" required>
                            <option value="" disabled selected>Choisissez une commune</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="arrondissement">Arrondissement</label>
                    <div class="input-wrapper">
                        <i class="bx bx-map-pin input-icon"></i>
                        <select id="arrondissement" name="arrondissement" required>
                            <option value="" disabled selected>Choisissez un arrondissement</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="quartier">Quartier</label>
                    <div class="input-wrapper">
                        <i class="bx bx-home input-icon"></i>
                        <select id="quartier" name="quartier">
                            <option value="" disabled selected>Choisissez un quartier</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-next">
                    <span>Suivant</span>
                    <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Étape 2 -->
        <div class="form-step">
            <h2 class="step-title">Activités et finances</h2>
            
            <div class="form-group">
                <label for="activite_principale">Activité Principale</label>
                <div class="input-wrapper">
                    <i class="bx bx-briefcase input-icon"></i>
                    <select id="activite_principale" name="activite_principale" required>
                        <option value="" disabled selected>Choisissez une activité principale</option>
                        @foreach($activites as $activite)
                            <option value="{{ $activite->activite_id }}">{{ $activite->activite }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="activite_secondaire">Activité Secondaire</label>
                <div class="input-wrapper">
                    <i class="bx bx-briefcase-alt input-icon"></i>
                    <select id="activite_secondaire" name="activite_secondaire">
                        <option value="" disabled selected>Choisissez une activité secondaire</option>
                        @foreach($activites as $activite)
                            <option value="{{ $activite->activite_id }}">{{ $activite->activite }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="filiere">Filière</label>
                <div class="input-wrapper">
                    <i class="bx bx-category input-icon"></i>
                    <select id="filiere" name="filiere" required>
                        <option value="" disabled selected>Choisissez une filière</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->filiere_id }}">{{ $filiere->filiere_nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="effectif">Effectif</label>
                    <div class="input-wrapper">
                        <i class="bx bx-user-plus input-icon"></i>
                        <input type="number" id="effectif" name="effectif" placeholder="Entrez l'effectif" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="revenu">Revenu mensuel</label>
                    <div class="input-wrapper">
                        <i class="bx bx-money input-icon"></i>
                        <input type="number" id="revenu" name="revenu" placeholder="Entrez votre revenu mensuel" min="0" step="0.01" required>
                    </div>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="depense">Dépense mensuelle</label>
                    <div class="input-wrapper">
                        <i class="bx bx-purchase-tag input-icon"></i>
                        <input type="number" id="depense" name="depense" placeholder="Entrez votre dépense mensuelle" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="benefice">Bénéfice mensuel</label>
                    <div class="input-wrapper">
                        <i class="bx bx-trending-up input-icon"></i>
                        <input type="number" id="benefice" name="benefice" placeholder="Entrez votre bénéfice mensuel" min="0" step="0.01" required>
                    </div>
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-prev">
                    <i class="bx bx-chevron-left"></i>
                    <span>Précédent</span>
                </button>
                <button type="button" class="btn-next">
                    <span>Suivant</span>
                    <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Étape 3 -->
        <div class="form-step">
            <h2 class="step-title">Appuis et soutiens</h2>
            
            <div class="form-group toggle-group">
                <div class="toggle-label">
                    <label for="appui">Bénéficiez-vous d'un appui ?</label>
                    <div class="toggle-switch">
                        <input type="checkbox" id="appui" name ="appui" value="1">
                        <span class="toggle-slider"></span>
                    </div>
                </div>
            </div>

            <div id="appui-details" class="conditional-section" style="display: none;">
                <div class="form-group">
                    <label for="type_appui">Type d'Appui</label>
                    <div class="input-wrapper">
                        <i class="bx bx-help-circle input-icon"></i>
                        <select id="type_appui" name="type_appui">
                            <option value="" disabled selected>Choisissez un type d'appui</option>
                            <option value="financier">Financier</option>
                            <option value="materiel">Matériel</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="structure_appui">Structure Responsable</label>
                    <div class="input-wrapper">
                        <i class="bx bx-buildings input-icon"></i>
                        <select id="structure_appui" name="structure">
                            <option value="" disabled selected>Choisissez une structure</option>
                            @foreach($structures as $structure)
                                <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description_appui">Description de l'Appui</label>
                    <div class="input-wrapper textarea-wrapper">
                        <i class="bx bx-detail input-icon"></i>
                        <textarea id="description_appui" name="description_appui" placeholder="Entrez une description de l'appui" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="annee_appui">Année d'Appui</label>
                    <div class="input-wrapper">
                        <i class="bx bx-calendar input-icon"></i>
                        <input type="date" id="annee_appui" name="annee_appui">
                    </div>
                </div>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-prev">
                    <i class="bx bx-chevron-left"></i>
                    <span>Précédent</span>
                </button>
                <button type="button" class="btn-next">
                    <span>Suivant</span>
                    <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Étape 4 -->
        <div class="form-step">
            <h2 class="step-title">Équipements et documentation</h2>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="equipement">Équipement</label>
                    <div class="input-wrapper">
                        <i class="bx bx-wrench input-icon"></i>
                        <input type="text" id="equipement" name="equipement" placeholder="Entrez l'équipement" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="etat_equipement">État de l'Équipement</label>
                    <div class="input-wrapper">
                        <i class="bx bx-check-circle input-icon"></i>
                        <select id="etat_equipement" name="etat_equipement" required>
                            <option value="" disabled selected>Choisissez l'état</option>
                            <option value="neuf">Neuf</option>
                            <option value="use">Usé</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description_difficulte">Difficulté</label>
                <div class="input-wrapper textarea-wrapper">
                    <i class="bx bx-error-circle input-icon"></i>
                    <textarea id="description_difficulte" name="description_difficulte" placeholder="Décrivez les difficultés rencontrées" rows="4"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="description_besoin">Besoins</label>
                <div class="input-wrapper textarea-wrapper">
                    <i class="bx bx-task input-icon"></i>
                    <textarea id="description_besoin" name="description_besoin" placeholder="Décrivez vos besoins" rows="4"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="structure_delivrance">Structure Responsable</label>
                <div class="input-wrapper">
                    <i class="bx bx-building-house input-icon"></i>
                    <select id="structure_delivrance" name="structure_delivrance">
                        <option value="" disabled selected>Choisissez une structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->structure_id }}">{{ $structure->structure }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="reference">Référence de l'agrément</label>
                    <div class="input-wrapper">
                        <i class="bx bx-id-card input-icon"></i>
                        <input type="text" id="reference" name="reference" placeholder="Entrez la référence" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="annee_delivrance">Année de Délivrance</label>
                    <div class="input-wrapper">
                        <i class="bx bx-calendar-check input-icon"></i>
                        <input type="date" id="annee_delivrance" name="annee_delivrance" required>
                    </div>
                </div>
            </div>

            <div class="form-group file-upload-group">
                <label for="agrement">Agrément (Fichier)</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-icon">
                        <i class="bx bx-upload"></i>
                    </div>
                    <div class="file-upload-text">Glissez-déposez votre fichier ou cliquez pour sélectionner</div>
                    <input type="file" id="agrement" name="agrement" multiple accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>
                <span class="file-format-hint">Formats acceptés: PDF, DOC, DOCX, JPG, PNG</span>
            </div>

            <div class="form-navigation">
                <button type="button" class="btn-prev">
                    <i class="bx bx-chevron-left"></i>
                    <span>Précédent</span>
                </button>
                <button type="submit" class="btn-submit">
                    <i class="bx bx-check"></i>
                    <span>Valider</span>
                </button>
            </div>
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
            for (let i = 0; i <= currentStep; i++) {
                progressSteps.eq(i).addClass('active');
            }
        }

        // Gestion du bouton "Suivant"
        $('.btn-next').on('click', function () {
            // Valider les champs obligatoires de l'étape courante avant de continuer
            let isValid = true;
            steps.eq(currentStep).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error');
                    $(this).parent('.input-wrapper').addClass('error-wrapper');
                    
                    // Animation de l'erreur
                    $(this).parent('.input-wrapper').effect('shake', { times: 2, distance: 5 }, 300);
                    
                    // Afficher un message d'erreur
                    if (!$(this).siblings('.error-tooltip').length) {
                        $(this).parent('.input-wrapper').append('<div class="error-tooltip">Ce champ est requis</div>');
                    }
                    
                    return false; // Sortir de la boucle each
                } else {
                    $(this).removeClass('error');
                    $(this).parent('.input-wrapper').removeClass('error-wrapper');
                    $(this).siblings('.error-tooltip').remove();
                }
            });

            if (isValid && currentStep < steps.length - 1) {
                steps.eq(currentStep).removeClass('active').fadeOut(300, function() {
                    currentStep++;
                    steps.eq(currentStep).addClass('active').fadeIn(300);
                    updateProgressBar();
                    
                    // Faire défiler vers le haut
                    $('html, body').animate({
                        scrollTop: $('.container-print').offset().top - 50
                    }, 500);
                });
            }
        });

        // Gestion du bouton "Précédent"
        $('.btn-prev').on('click', function() {
            if (currentStep > 0) {
                steps.eq(currentStep).removeClass('active').fadeOut(300, function() {
                    currentStep--;
                    steps.eq(currentStep).addClass('active').fadeIn(300);
                    updateProgressBar();
                    
                    // Faire défiler vers le haut
                    $('html, body').animate({
                        scrollTop: $('.container-print').offset().top - 50
                    }, 500);
                });
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
    });

    document.addEventListener('DOMContentLoaded', function () {
        const appuiCheckbox = document.getElementById('appui');
        const appuiDetails = document.getElementById('appui-details');

        // Gestion de l'affichage des détails d'appui
        appuiCheckbox.addEventListener('change', function () {
            if (this.checked) {
                appuiDetails.style.display = 'block'; // Affiche la section
            } else {
                appuiDetails.style.display = 'none'; // Masque la section
                // Réinitialiser les champs d'appui
                appuiDetails.querySelectorAll('input, select, textarea').forEach(field => {
                    field.value = '';
                });
            }
        });
    });
</script>

<style>
    .container-print {
        max-width: 1000px;
        margin: 7rem 1rem 1rem 25rem;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(155, 135, 245, 0.15);
        font-family: 'Poppins', sans-serif;
    }

    .progress-container {
        margin-bottom: 2rem;
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 2rem;
        padding: 0 1rem;
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 10%;
        width: 80%;
        height: 3px;
        background-color: #e0e0e0;
        z-index: 1;
    }

    .step {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2;
        width: 25%;
        transition: all 0.3s ease;
    }

    .step-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #e0e0e0;
        color: #777;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .step-text {
        font-size: 0.85rem;
        color: #777;
        text-align: center;
        transition: all 0.3s ease;
    }

    .step.active .step-icon {
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: white;
        box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
    }

    .step.active .step-text {
        color: #9b87f5;
        font-weight: 600;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }

    .step-title {
        font-size: 1.8rem;
        color: #1A1F2C;
        margin-bottom: 1.8rem;
        text-align: center;
        position: relative;
        padding-bottom: 0.8rem;
    }

    .step-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #9b87f5, #7a6ad8);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .location-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .form-grid, .location-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1A1F2C;
        font-size: 0.95rem;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        color: #9b87f5;
        font-size: 1.2rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.8rem;
        font-size: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .textarea-wrapper textarea {
        width: 100%;
        padding: 1rem 1rem 1rem 2.8rem;
        font-size: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        resize: vertical;
    }

    .textarea-wrapper .input-icon {
        top: 1rem;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
        box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
        background-color: #fff;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #adb5bd;
    }

    .toggle-group {
        margin-bottom: 2rem;
    }

    .toggle-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e0e0e0;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #9b87f5;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(30px);
    }

    .conditional-section {
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #9b87f5;
        margin-bottom: 2rem;
    }

    .file-upload-group {
        margin-top: 2rem;
    }

    .file-upload-wrapper {
        position: relative;
        border: 2px dashed #9b87f5;
        border-radius: 8px;
        padding: 2rem 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .file-upload-wrapper:hover {
        background-color: #f0ecfd;
    }

    .file-upload-wrapper.highlight {
        border-color: #7a6ad8;
        background-color: #f0ecfd;
    }

    .file-upload-icon {
        font-size: 2rem;
        color: #9b87f5;
        margin-bottom: 0.5rem;
    }

    .file-upload-text {
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .file-upload-wrapper input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-format-hint {
        display: block;
        font-size: 0.8rem;
        color: #adb5bd;
        margin-top: 0.5rem;
        text-align: center;
    }

    .form-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        gap: 1rem;
    }

    .btn-next,
    .btn-prev,
    .btn-submit {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-next {
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: #fff;
        border: none;
        margin-left: auto;
        box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
    }

    .btn-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
    }

    .btn-prev {
        background-color: transparent;
        border: 1px solid #e0e0e0;
        color: #6c757d;
    }

    .btn-prev:hover {
        background-color: #f8f9fa;
        color: #495057;
    }

    .btn-submit {
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: #fff;
        border: none;
        box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
    }

    .error {
        border-color: #ea384c !important;
    }

    .error-wrapper {
        animation: shake 0.3s;
    }

    .error-tooltip {
        position: absolute;
        right: 0;
        top: 100%;
        background-color: #ea384c;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        z-index: 10;
    }

    .error-tooltip::before {
        content: '';
        position: absolute;
        top: -5px;
        right: 10px;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid #ea384c;
    }

    @keyframes shake {
        0%, 100% {transform: translateX(0);}
        10%, 30%, 50%, 70%, 90% {transform: translateX(-5px);}
        20%, 40%, 60%, 80% {transform: translateX(5px);}
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
