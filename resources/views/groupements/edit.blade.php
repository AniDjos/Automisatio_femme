@extends('welcome')

@section('name', 'Modifier un Groupement')

@section('content')
<div class="container-print">
    <!-- Barre de progression améliorée -->
    <div class="progress-container">
        <div class="progress-bar">
            <div class="step active">
                <span class="step-number">1</span>
                <span class="step-text">Informations générales</span>
            </div>
            <div class="step">
                <span class="step-number">2</span>
                <span class="step-text">Activités et Finances</span>
            </div>
            <div class="step">
                <span class="step-number">3</span>
                <span class="step-text">Appui et Soutien</span>
            </div>
            <div class="step">
                <span class="step-number">4</span>
                <span class="step-text">Équipement et Documentation</span>
            </div>
        </div>
    </div>

    <form id="multi-step-form" action="{{ route('groupements.update', $groupement->groupement_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Étape 1 -->
        <div class="form-step active">
            <div class="step-header">
                <h2>Informations générales</h2>
                <p class="step-description">Complétez les informations de base concernant le groupement</p>
            </div>
            
            <div class="form-card">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nom">Nom du Groupement</label>
                        <input type="text" id="nom" name="nom" value="{{ $groupement->nom }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="date_creation">Date de Création</label>
                        <input type="date" id="date_creation" name="date_creation" value="{{ $groupement->date_creation }}" required>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-title">Localisation</h3>
                    <div class="form-grid">
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
                    </div>
                </div>
            </div>
            
            <div class="btn-container">
                <button type="button" class="btn-next">Continuer <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>
            </div>
        </div>

        <!-- Étape 2 -->
        <div class="form-step">
            <div class="step-header">
                <h2>Activités et Finances</h2>
                <p class="step-description">Détaillez les activités économiques et la situation financière</p>
            </div>
            
            <div class="form-card">
                <div class="form-section">
                    <h3 class="section-title">Activités</h3>
                    <div class="form-grid">
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
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-title">Situation Financière</h3>
                    <div class="finance-grid">
                        <div class="form-group">
                            <label for="revenu">Revenu mensuel</label>
                            <div class="input-with-icon">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 17h2.5a2 2 0 0 0 1.8-1.1l7.3-14.2a2 2 0 0 1 1.8-1.1h4.6a2 2 0 0 1 2 2.5l-2.2 9.9a2 2 0 0 1-2 1.5H8"/><circle cx="5" cy="20" r="2"/><circle cx="16" cy="20" r="2"/></svg>
                                <input type="number" id="revenu" name="revenu" value="{{ $groupement->revenu_mens }}" min="0" step="0.01" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="depense">Dépense mensuelle</label>
                            <div class="input-with-icon">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 7.8l-7.7 7.7-4-4-5.7 5.7"/><path d="M15 7h6v6"/></svg>
                                <input type="number" id="depense" name="depense" value="{{ $groupement->depense_mens }}" min="0" step="0.01" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="benefice">Bénéfice mensuel</label>
                            <div class="input-with-icon">
                                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 17.2l-7.7-7.7-4 4-5.7-5.7"/><path d="M15 18h6v-6"/></svg>
                                <input type="number" id="benefice" name="benefice" value="{{ $groupement->benefice_mens }}" min="0" step="0.01" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="btn-container">
                <button type="button" class="btn-prev"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg> Retour</button>
                <button type="button" class="btn-next">Continuer <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>
            </div>
        </div>

        <!-- Étape 3 -->
        <div class="form-step">
            <div class="step-header">
                <h2>Appui et Soutien</h2>
                <p class="step-description">Indiquez les appuis dont bénéficie le groupement</p>
            </div>
            
            <div class="form-card">
                <div class="form-section">
                    <div class="toggle-container">
                        <label class="toggle-label">Bénéficiez-vous d'un appui ?</label>
                        <label class="switch">
                            <input type="checkbox" id="appui" name="appui" value="1" {{ $groupement->appui ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    
                    <div id="appui-details" style="{{ $groupement->appui ? '' : 'display: none;' }}">
                        <div class="form-grid">
                        @foreach($appuis as $appui)
                            <div class="form-group">
                                <label for="type_appui_{{ $appui->id }}">Type d'Appui</label>
                                <input type="text" id="type_appui_{{ $appui->id }}" name="appuis[{{ $appui->id }}][type]" value="{{ $appui->type_appuis }}" required>
                            </div>
                            
                            
                        
                            <div class="form-group full-width">
                                <label for="description_appui_{{ $appui->id }}"> Description de l'Appui</label>
                                <textarea id="description_appui_{{ $appui->id }}" name="appuis[{{ $appui->id }}][description]" rows="4" >{{ $appui->description }}</textarea>
                            </div>
                        
                            <div class="form-group">
                                <label for="annee_appui_{{ $appui->id }}">Année d'Appui</label>
                                <input type="date" id="annee_appui_{{ $appui->id }}" name="appuis[{{ $appui->id }}][annee]" value="{{ $appui->date_appuis }}" required>
                            </div>
                        @endforeach

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
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="btn-container">
                <button type="button" class="btn-prev"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg> Retour</button>
                <button type="button" class="btn-next">Continuer <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>
            </div>
        </div>

        <!-- Étape 4 -->
        <div class="form-step">
            <div class="step-header">
                <h2>Équipement et Documentation</h2>
                <p class="step-description">Complétez les informations sur l'équipement et la documentation</p>
            </div>
            
            <div class="form-card">
                <div class="form-section">
                    <h3 class="section-title">Équipement</h3>
                    <div class="form-grid">
                    @foreach($equipements as $equipement)
                        <div class="form-group">
                            <label for="nom_equipement_{{ $equipement->id }}">Équipement</label>
                            <input type="text" id="nom_equipement_{{ $equipement->id }}" name="equipements[{{ $equipement->id }}][nom]" value="{{ $equipement->equipment_libelle }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="etat_equipement_{{ $equipement->id }}">État de l'Équipement</label>
                            <select id="etat_equipement_{{ $equipement->id }}" name="equipements[{{ $equipement->id }}][etat]" required>
                            <option value="neuf" {{ $equipement->stat_equipement == 'neuf' ? 'selected' : '' }}>Neuf</option>
                            <option value="use" {{ $equipement->stat_equipement == 'use' ? 'selected' : '' }}>Usé</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-title">Difficultés et Besoins</h3>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="description_difficulte_{{ $equipement->id }}">Difficultés rencontrées</label>
                            <textarea id="description_difficulte_{{ $equipement->id }}" name="equipements[{{ $equipement->id }}][difficulte]" rows="3">{{ $equipement->description_difficultie }}</textarea>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="description_besoin_{{ $equipement->id }}">Besoins</label>
                            <textarea id="description_besoin_{{ $equipement->id }}" name="equipements[{{ $equipement->id }}][besoin]" rows="3">{{ $equipement->description_besoin }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="form-section">
                    <h3 class="section-title">Documentation</h3>
                    <div class="form-grid">
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
                        @foreach($agrements as $agrement)
                        <div class="form-group">
                            <label for="reference_agrement_{{ $agrement->id }}">Référence de l'agrément</label>
                            <input type="text" id="reference_agrement_{{ $agrement->id }}" name="reference_agrement" value="{{ $agrement->reference }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_agrement_{{ $agrement->id }}">Année de Délivrance</label>
                            <input type="date" id="date_agrement_{{ $agrement->id }}" name="agrements[{{ $agrement->id }}][date]" value="{{ $agrement->date_deliver }}" required>
                        </div>
                        
                        <!-- <div class="form-group upload-group">
                            <label for="agrement">Agrément (Fichier)</label>
                            <div class="file-upload">
                            <input type="file" id="agrement_{{ $agrement->id }}" name="agrements[{{ $agrement->id }}][file]" accept=".pdf,.doc,.docx,.jpg,.png" >
                                <label for="agrement" class="file-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    <span>Choisir un fichier</span>
                                </label>
                                <div class="file-info">
                                        <a href="{{ asset('storage/' . $agrement->document) }}" target="_blank">Voir le fichier existant</a>
                                </div>
                            </div>
                        </div> -->
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="btn-container">
                <button type="button" class="btn-prev"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg> Retour</button>
                <button type="submit" class="btn-submit">Valider les modifications <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></button>
            </div>
        </div>
    </form>
</div>

<style>
    /* Base styles */
    .container-print {
        width: 1000PX;
        margin: 6rem 1rem 1rem 19rem;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    /* Progress bar styling */
    .progress-container {
        margin-bottom: 3rem;
    }
    
    .progress-bar {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 0;
        margin-bottom: 2rem;
    }
    
    .progress-bar::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: #E5DEFF;
        z-index: 1;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        width: 25%;
        z-index: 2;
    }
    
    .step-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #F6F6F7;
        border: 3px solid #E5DEFF;
        color: #8A898C;
        font-weight: 600;
        margin-bottom: 0.8rem;
        transition: all 0.4s ease;
        position: relative;
        z-index: 3;
    }
    
    .step-text {
        font-size: 0.9rem;
        color: #8A898C;
        text-align: center;
        transition: all 0.3s ease;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    
    .step.active .step-number {
        background-color: #9b87f5;
        border-color: #E5DEFF;
        color: white;
        box-shadow: 0 0 0 6px rgba(155, 135, 245, 0.2);
    }
    
    .step.active .step-text {
        color: #1A1F2C;
        font-weight: 600;
    }

    /* Form card styling */
    .form-card {
        background-color: #FFFFFF;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f0f5;
        margin-bottom: 1.5rem;
    }
    
    .step-header {
        margin-bottom: 1.5rem;
    }
    
    .step-header h2 {
        font-size: 1.8rem;
        color: #1A1F2C;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .step-description {
        color: #6B7280;
        font-size: 1rem;
        margin-bottom: 1rem;
    }
    
    .section-title {
        font-size: 1.2rem;
        color: #3F3D56;
        font-weight: 600;
        margin-bottom: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #F6F6F7;
    }
    
    .form-section {
        margin-bottom: 2rem;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .full-width {
        grid-column: 1 / -1;
    }
    
    /* Form inputs styling */
    .form-group {
        margin-bottom: 1.2rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.6rem;
        color: #4B5563;
        font-size: 0.95rem;
    }
    
    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid #E5DEFF;
        border-radius: 10px;
        font-size: 1rem;
        background-color: #F9F9FB;
        transition: all 0.25s ease;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #9b87f5;
        outline: none;
        box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
        background-color: #ffffff;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    /* Input with icon styling */
    .input-with-icon {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9b87f5;
    }
    
    .input-with-icon input {
        padding-left: 40px !important;
    }
    
    /* Finance grid styling */
    .finance-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.2rem;
        background-color: #F9F8FF;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #9b87f5;
    }
    
    /* Toggle switch styling */
    .toggle-container {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .toggle-label {
        margin-right: 1rem;
        font-weight: 500;
        color: #4B5563;
    }
    
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #E5DEFF;
        transition: .4s;
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
    }
    
    input:checked + .slider {
        background-color: #9b87f5;
    }
    
    input:focus + .slider {
        box-shadow: 0 0 1px #9b87f5;
    }
    
    input:checked + .slider:before {
        transform: translateX(26px);
    }
    
    .slider.round {
        border-radius: 34px;
    }
    
    .slider.round:before {
        border-radius: 50%;
    }
    
    /* Radio button styling */
    .radio-group {
        display: flex;
        gap: 1.5rem;
        padding: 0.5rem 0;
    }
    
    .radio-option {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    
    .radio-option input[type="radio"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        accent-color: #9b87f5;
    }
    
    .radio-label {
        font-weight: normal;
        color: #4B5563;
    }
    
    /* File upload styling */
    .upload-group {
        grid-column: 1 / -1;
    }
    
    .file-upload {
        position: relative;
    }
    
    .file-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        overflow: hidden;
    }
    
    .file-label {
        display: flex;
        align-items: center;
        padding: 0.8rem 1.5rem;
        background-color: #F9F8FF;
        border: 2px dashed #9b87f5;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    
    .file-label svg {
        margin-right: 10px;
        color: #9b87f5;
    }
    
    .file-label:hover {
        background-color: #F5F2FF;
    }
    
    .file-info {
        margin-top: 0.6rem;
        font-size: 0.9rem;
        color: #6B7280;
    }
    
    /* Button styling */
    .btn-container {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }
    
    .btn-prev,
    .btn-next,
    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.8rem 1.8rem;
        font-size: 0.95rem;
        font-weight: 500;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        gap: 0.5rem;
    }
    
    .btn-prev {
        color: #6B7280;
        background-color: #F9F9FB;
        border: 1.5px solid #E5E7EB;
    }
    
    .btn-prev:hover {
        background-color: #F3F4F6;
    }
    
    .btn-next {
        color: #fff;
        background-color: #9b87f5;
        border: none;
    }
    
    .btn-next:hover {
        background-color: #8a73e8;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(155, 135, 245, 0.3);
    }
    
    .btn-submit {
        color: #fff;
        background-color: #22C55E;
        border: none;
    }
    
    .btn-submit:hover {
        background-color: #16A34A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }
    
    /* Form step animation */
    .form-step {
        display: none;
        animation: fadeIn 0.5s ease forwards;
    }
    
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .form-step.active {
        display: block;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container-print {
            margin: 1rem auto;
            padding: 1.5rem 1rem;
            width: 95%;
        }
        
        .progress-bar {
            overflow-x: auto;
            padding-bottom: 1rem;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
        
        .step-text {
            font-size: 0.8rem;
        }
        
        .form-card {
            padding: 1.5rem 1rem;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .btn-container {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-prev, .btn-next, .btn-submit {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.form-step');
        const nextButtons = document.querySelectorAll('.btn-next');
        const prevButtons = document.querySelectorAll('.btn-prev');
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
            
            // Scroll to top when changing steps
            window.scrollTo({ top: 0, behavior: 'smooth' });
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
        
        // Gestion des boutons "Retour"
        prevButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
        });

        // Toggle d'appui
        const appuiCheckbox = document.getElementById('appui');
        const appuiDetails = document.getElementById('appui-details');

        appuiCheckbox.addEventListener('change', function () {
            if (appuiCheckbox.checked) {
                appuiDetails.style.display = 'block';
            } else {
                appuiDetails.style.display = 'none';
                // Réinitialiser les champs d'appui
                appuiDetails.querySelectorAll('input:not([type="checkbox"]), select, textarea').forEach(field => {
                    field.value = '';
                });
            }
        });
        
        // Affichage du nom de fichier sélectionné
        const fileInput = document.getElementById('agrement');
        const fileInfo = document.querySelector('.file-info');
        
        if (fileInput && fileInfo) {
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileInfo.textContent = fileInput.files[0].name;
                } else {
                    fileInfo.textContent = 'Aucun fichier sélectionné';
                }
            });
        }

        // Afficher la première étape au chargement
        showStep(currentStep);
    });
</script>
@endsection
