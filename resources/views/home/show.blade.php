@extends('welcome')

@section('name', 'Détails du Groupement')

@section('content')
<div class="dashboard-container">
    <!-- Header avec titre et actions -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">{{ $groupement->groupement_nom }}</h1>
            <p class="dashboard-subtitle">Détails du groupement</p>
        </div>
        
        <div class="header-actions">
            <div class="action-dropdown">
                <button class="action-button">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('App_groupement') }}" class="dropdown-item">
                        <i class="fas fa-list"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Contenu principal -->
    <div class="dashboard-content">
        <!-- Section Informations Générales -->
        <div class="info-card">
            <div class="card-header">
                <h2><i class="fas fa-info-circle"></i> Informations Générales</h2>
            </div>
            <div class="card-body grid-layout">
                <div class="info-item">
                    <span class="info-label">Nom</span>
                    <span class="info-value">{{ $groupement->groupement_nom }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Effectif</span>
                    <span class="info-value">{{ $groupement->effectif }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date création</span>
                    <span class="info-value">{{ $groupement->date_creation }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Localisation</span>
                    <span class="info-value">
                        {{ $groupement->departement_nom ?? 'N/A' }} > 
                        {{ $groupement->commune_nom ?? 'N/A' }} > 
                        {{ $groupement->arrondissement_nom ?? 'N/A' }} > 
                        {{ $groupement->quartier_nom ?? 'N/A' }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Filière</span>
                    <span class="info-value">{{ $groupement->filiere_nom ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Activités</span>
                    <span class="info-value">
                        Principal: {{ $groupement->activite_principale_nom ?? 'N/A' }}<br>
                        Secondaire: {{ $groupement->activite_secondaire_nom ?? 'N/A' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Section Finances -->
        <div class="info-card financial-card">
            <div class="card-header">
                <h2><i class="fas fa-chart-line"></i> Situation Financière</h2>
            </div>
            <div class="card-body">
                <div class="financial-grid">
                    <div class="financial-item revenue">
                        <span class="financial-label">Revenu Mensuel</span>
                        <span class="financial-value">{{ number_format($groupement->revenu_mens, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="financial-item expense">
                        <span class="financial-label">Dépense Mensuelle</span>
                        <span class="financial-value">{{ number_format($groupement->depense_mens, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="financial-item profit">
                        <span class="financial-label">Bénéfice</span>
                        <span class="financial-value">{{ number_format($groupement->benefice_mens, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
                <div class="financial-chart">
                    <canvas id="financeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
:root {
    --primary-color: #c3bd35;
    --primary-light: #c2bd35;
    --secondary-color: #00cec9;
    --success-color: #00b894;
    --warning-color: #fdcb6e;
    --danger-color: #d63031;
    --light-color: #f5f6fa;
    --dark-color: #2d3436;
    --text-color: #636e72;
    --border-color: #dfe6e9;
    --card-shadow: 0 4px 20px rgba(108, 92, 231, 0.1);
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    color: var(--text-color);
}

.dashboard-container {
    width: 1200px;
    margin: 7rem 1rem 2rem 10rem;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.header-content {
    flex: 1;
}

.dashboard-title {
    font-size: 2rem;
    color: black;
    margin: 0;
    font-weight: 700;
    padding-top: 2rem
}

.dashboard-subtitle {
    font-size: 1rem;
    color: var(--text-color);
    margin: 0.5rem 0 0;
    opacity: 0.8;
}

.header-actions {
    position: relative;
}

.action-button {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.action-button:hover {
    background: var(--primary-light);
    transform: rotate(90deg);
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background: white;
    min-width: 200px;
    box-shadow: var(--card-shadow);
    border-radius: 8px;
    z-index: 100;
    overflow: hidden;
}

.action-dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-item {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-color);
    text-decoration: none;
    transition: all 0.2s ease;
}

.dropdown-item i {
    width: 20px;
    text-align: center;
}

.dropdown-item:hover {
    background: var(--light-color);
    color: var(--primary-color);
}

.dropdown-item.danger {
    color: var(--danger-color);
}

.dropdown-item.danger:hover {
    background: rgba(214, 48, 49, 0.1);
}

.dropdown-item.warning {
    color: var(--warning-color);
}

.dropdown-item.success {
    color: var(--success-color);
}

.dashboard-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.info-card {
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
}

.small-card {
    height: 100%;
}

.dual-card-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.card-header {
    padding: 1.25rem 1.5rem;
    background: var(--primary-color);
    color: white;
}

.card-header h2 {
    margin: 0;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-body {
    padding: 1.5rem;
}

.grid-layout {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.25rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-label {
    font-size: 0.85rem;
    color: var(--text-color);
    opacity: 0.7;
    font-weight: 500;
}

.info-value {
    font-size: 1rem;
    color: var(--dark-color);
    font-weight: 600;
}

.financial-card .card-body {
    padding: 0;
}

.financial-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border-color);
}

.financial-item {
    padding: 1.5rem;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.financial-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.financial-value {
    font-size: 1.25rem;
    font-weight: 700;
}

.revenue .financial-value {
    color: var(--success-color);
}

.expense .financial-value {
    color: var(--danger-color);
}

.profit .financial-value {
    color: var(--primary-color);
}

.financial-chart {
    padding: 1.5rem;
    height: 300px;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    text-align: center;
    color: var(--text-color);
    opacity: 0.7;
}

.empty-state i {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--border-color);
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

.status-badge.excellent {
    background: rgba(0, 184, 148, 0.1);
    color: var(--success-color);
}

.status-badge.bon {
    background: rgba(253, 203, 110, 0.1);
    color: var(--warning-color);
}

.status-badge.mauvais {
    background: rgba(214, 48, 49, 0.1);
    color: var(--danger-color);
}

@media (max-width: 768px) {
    .dual-card-container {
        grid-template-columns: 1fr;
    }
    
    .financial-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .header-actions {
        align-self: flex-end;
    }
}
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Financier
    const financeCtx = document.getElementById('financeChart').getContext('2d');
    new Chart(financeCtx, {
        type: 'bar',
        data: {
            labels: ['Revenu', 'Dépense', 'Bénéfice'],
            datasets: [{
                label: 'Montant (FCFA)',
                data: [
                    {{ $groupement->revenu_mens }},
                    {{ $groupement->depense_mens }},
                    {{ $groupement->benefice_mens }}
                ],
                backgroundColor: [
                    'rgba(0, 184, 148, 0.7)',
                    'rgba(214, 48, 49, 0.7)',
                    'rgba(108, 92, 231, 0.7)'
                ],
                borderColor: [
                    'rgba(0, 184, 148, 1)',
                    'rgba(214, 48, 49, 1)',
                    'rgba(108, 92, 231, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y.toLocaleString() + ' FCFA';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection