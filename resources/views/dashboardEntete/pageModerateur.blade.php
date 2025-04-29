@extends('welcome')

@section('name', 'Dashboard du Groupement')

@section('content')
<div class="groupement-dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class='bx bx-group'></i> Dashboard du Groupement
        </h1>
    </div>

    <div class="elegant-card">
        <div class="card-header bg-muted">
            <h2 class="card-title">
                <i class='bx bx-buildings'></i> {{ $groupement->nom }}
            </h2>
            <p class="card-subtitle">Créé le {{ \Carbon\Carbon::parse($groupement->date_creation)->format('d/m/Y') }}</p>
        </div>

        <div class="card-content">
            <div class="tabs-container">
                <ul class="tabs-list">
                    <li class="tab-item active" data-tab="informations">
                        <i class='bx bx-info-circle'></i> Informations
                    </li>
                    <li class="tab-item" data-tab="activites">
                        <i class='bx bx-file-text'></i> Activités
                    </li>
                    <li class="tab-item" data-tab="finances">
                        <i class='bx bx-bar-chart-alt-2'></i> Finances
                    </li>
                    <li class="tab-item" data-tab="appuis">
                        <i class='bx bx-support'></i> Appuis
                    </li>
                </ul>

                <div class="tab-content active" id="informations-tab">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-card">
                            <h3 class="info-card-title">Localisation</h3>
                            <div class="info-card-content">
                                <dl class="info-list">
                                    <div class="info-item">
                                        <dt>Département:</dt>
                                        <dd>{{ $groupement->localisation->departement }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Commune:</dt>
                                        <dd>{{ $groupement->localisation->commune }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Arrondissement:</dt>
                                        <dd>{{ $groupement->localisation->arrondissement }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Quartier:</dt>
                                        <dd>{{ $groupement->localisation->quartier }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="info-card">
                            <h3 class="info-card-title">Agrément</h3>
                            <div class="info-card-content">
                                <dl class="info-list">
                                    <div class="info-item">
                                        <dt>Structure:</dt>
                                        <dd>{{ $groupement->agrement->structure }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Référence:</dt>
                                        <dd>{{ $groupement->agrement->reference }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Date de délivrance:</dt>
                                        <dd>{{ \Carbon\Carbon::parse($groupement->agrement->annee)->format('d/m/Y') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="activites-tab">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-card">
                            <h3 class="info-card-title">Activités</h3>
                            <div class="info-card-content">
                                <dl class="info-list">
                                    <div class="info-item">
                                        <dt>Activité principale:</dt>
                                        <dd>{{ $groupement->activites->principale }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Activité secondaire:</dt>
                                        <dd>{{ $groupement->activites->secondaire ?? 'Aucune' }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Filière:</dt>
                                        <dd>{{ $groupement->filiere }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>Effectif:</dt>
                                        <dd>{{ $groupement->effectif }} membres</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="info-card">
                            <h3 class="info-card-title">Équipement</h3>
                            <div class="info-card-content">
                                <dl class="info-list">
                                    <div class="info-item">
                                        <dt>Description:</dt>
                                        <dd>{{ $groupement->equipement->nom }}</dd>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="info-item">
                                        <dt>État:</dt>
                                        <dd class="capitalize">{{ $groupement->equipement->etat }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="finances-tab">
                    <div class="info-card">
                        <h3 class="info-card-title">Informations Financières</h3>
                        <div class="info-card-content">
                            <dl class="info-list">
                                <div class="info-item">
                                    <dt>Revenu mensuel:</dt>
                                    <dd>{{ number_format($groupement->finances->revenu_mensuel, 0, ',', ' ') }} FCFA</dd>
                                </div>
                                <div class="separator"></div>
                                <div class="info-item">
                                    <dt>Dépense mensuelle:</dt>
                                    <dd>{{ number_format($groupement->finances->depense_mensuelle, 0, ',', ' ') }} FCFA</dd>
                                </div>
                                <div class="separator"></div>
                                <div class="info-item">
                                    <dt>Bénéfice mensuel:</dt>
                                    <dd class="text-success">{{ number_format($groupement->finances->benefice_mensuel, 0, ',', ' ') }} FCFA</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="appuis-tab">
                    <div class="info-card">
                        <h3 class="info-card-title">Appuis et Besoins</h3>
                        <div class="info-card-content">
                            @if($groupement->appui->beneficie)
                                <div class="mb-6">
                                    <h4 class="section-subtitle">Appui Reçu</h4>
                                    <div class="bg-muted p-4 rounded-lg">
                                        <dl class="info-list">
                                            <div class="info-item">
                                                <dt>Type d'appui:</dt>
                                                <dd class="capitalize">{{ $groupement->appui->type }}</dd>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="info-item">
                                                <dt>Structure:</dt>
                                                <dd>{{ $groupement->appui->structure }}</dd>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="info-item">
                                                <dt>Année:</dt>
                                                <dd>{{ \Carbon\Carbon::parse($groupement->appui->annee)->format('d/m/Y') }}</dd>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="mt-3">
                                                <dt class="font-medium">Description:</dt>
                                                <dd class="bg-white p-3 rounded mt-1">{{ $groupement->appui->description }}</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            @else
                                <p>Le groupement ne bénéficie pas d'appuis pour le moment.</p>
                            @endif

                            <div class="mb-6">
                                <h4 class="section-subtitle">Difficultés</h4>
                                <div class="bg-white p-4 rounded-lg">
                                    <p>{{ $groupement->difficultes }}</p>
                                </div>
                            </div>

                            <div>
                                <h4 class="section-subtitle">Besoins</h4>
                                <div class="bg-white p-4 rounded-lg">
                                    <p>{{ $groupement->besoins }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS */
:root {
    --primary: #9b87f5;
    --primary-light: #c5b8fa;
    --primary-dark: #7a6ad8;
    --secondary: #6c5ce7;
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --muted: #6c757d;
    --white: #ffffff;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 20px rgba(0,0,0,0.1);
    --transition: all 0.3s ease;
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
}

/* Base Styles */
.groupement-dashboard-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Inter', 'Poppins', sans-serif;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.dashboard-title i {
    color: var(--primary);
    font-size: 1.8rem;
}

.elegant-card {
    background-color: var(--white);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.card-header {
    padding: 1.5rem;
    background-color: var(--light);
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.card-header.bg-muted {
    background-color: rgba(108, 117, 125, 0.1);
}

.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-title i {
    color: var(--primary);
}

.card-subtitle {
    color: var(--muted);
    font-size: 0.9rem;
    margin: 0.5rem 0 0 0;
}

.card-content {
    padding: 1.5rem;
}

/* Tabs Styles */
.tabs-container {
    margin-top: 1rem;
}

.tabs-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.tab-item {
    padding: 0.75rem 1rem;
    text-align: center;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-weight: 500;
    color: var(--muted);
    background-color: var(--light);
}

.tab-item i {
    font-size: 1.1rem;
}

.tab-item:hover {
    color: var(--primary);
    background-color: rgba(155, 135, 245, 0.1);
}

.tab-item.active {
    color: var(--white);
    background-color: var(--primary);
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Info Card Styles */
.info-card {
    background-color: var(--white);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.info-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    padding: 1rem 1.5rem;
    margin: 0;
    border-bottom: 1px solid var(--light);
}

.info-card-content {
    padding: 1.5rem;
}

.info-list {
    margin: 0;
    padding: 0;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
}

.info-item dt {
    font-weight: 500;
    color: var(--muted);
}

.info-item dd {
    color: var(--dark);
    text-align: right;
}

.capitalize {
    text-transform: capitalize;
}

.text-success {
    color: var(--success);
    font-weight: 600;
}

.separator {
    height: 1px;
    background-color: var(--light);
    margin: 0.5rem 0;
}

.section-subtitle {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--dark);
}

/* Responsive */
@media (max-width: 768px) {
    .tabs-list {
        grid-template-columns: 1fr;
    }
    
    .grid-cols-1.md\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
}

/* Include Boxicons CSS */
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.tab-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });
});
</script>
@endsection