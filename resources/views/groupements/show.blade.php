@extends('welcome')

@section('name', 'Détails du Groupement')

@section('content')
<h1 style="margin: 2.5rem 2rem 2rem 17rem;color:#9b87f5;font-size: 24px;font-weight: bold; text-align:center">Tableau de board - {{ $groupement->groupement_nom }}</h1>
<div class="dashboard">
    
    <div class="charts">
        <div class="chart">
            <h3>Effectif</h3>
            <canvas id="effectifChart"></canvas>
        </div>
        <div class="chart">
            <h3>Répartition des Appuis</h3>
            <canvas id="appuiChart"></canvas>
        </div>
    </div>
</div>

<div class="content">
    <!-- Cadre principal -->
    <div class="left-panel">
        <h2>Informations Générales</h2>
        <div class="details">
            <p><strong>Nom :</strong> {{ $groupement->groupement_nom }}</p>
            <p><strong>Effectif :</strong> {{ $groupement->effectif }}</p>
            <p><strong>Date de création :</strong> {{ $groupement->date_creation }}</p>
            <p><strong>Département :</strong> {{ $groupement->departement_nom ?? 'Non spécifié' }}</p>
            <p><strong>Commune :</strong> {{ $groupement->commune_nom ?? 'Non spécifié' }}</p>
            <p><strong>Arrondissement :</strong> {{ $groupement->arrondissement_nom ?? 'Non spécifié' }}</p>
            <p><strong>Quartier :</strong> {{ $groupement->quartier_nom ?? 'Non spécifié' }}</p>
            <p><strong>Activité principale :</strong> {{ $groupement->activite_principale_nom ?? 'Non spécifié' }}</p>
            <p><strong>Activité secondaire :</strong> {{ $groupement->activite_secondaire_nom ?? 'Non spécifié' }}</p>
        </div>
    </div>

    <!-- Cadres à droite -->
    <div class="right-panel">
        <div class="card">
            <h2>Appuis</h2>
            @if ($groupement->appui_type)
                <p><strong>Type :</strong> {{ $groupement->appui_type }}</p>
                <p><strong>Description :</strong> {{ $groupement->appui_description }}</p>
                <p><strong>Date :</strong> {{ $groupement->appui_date }}</p>
            @else
                <p>Aucun appui enregistré.</p>
            @endif
        </div>

        <div class="card">
            <h2>Agréments</h2>
            @if ($groupement->agrement_structure)
                <p><strong>Structure :</strong> {{ $groupement->agrement_structure }}</p>
                <p><strong>Référence :</strong> {{ $groupement->agrement_reference }}</p>
                <p><strong>Date de délivrance :</strong> {{ $groupement->agrement_date }}</p>
            @else
                <p>Aucun agrément enregistré.</p>
            @endif
        </div>
    </div>
</div>

<div class="content1">
        <div class="card">
            <h2>Equipement</h2>
            @if ($groupement->agrement_structure)
                <p><strong>Nom Equipement :</strong> {{ $groupement->equipement }}</p>
                <p><strong>Etat Equipement :</strong> {{ $groupement->etat_equipement }}</p>
                <p><strong>Difficulté :</strong> {{ $groupement->description_difficultie }}</p>
                <p><strong>Besoin :</strong> {{ $groupement->description_besoin }}</p>
            @else
                <p>Aucun agrément enregistré.</p>
            @endif
        </div>
</div>

<a href="{{ route('groupements.index') }}" class="btn-back">Retour à la liste</a>

<!-- Boutons Modifier, Supprimer et Activer/Désactiver -->
<div class="action-buttons">
    <a href="{{ route('groupements.edit', $groupement->groupement_id) }}" class="btn-edit">Modifier</a>
    <form action="{{ route('groupements.destroy', $groupement->groupement_id) }}" method="POST" class="btn-delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce groupement ?')">Supprimer</button>
    </form>

    <!-- Bouton Activer/Désactiver -->
    <form action="{{ route('groupements.toggleStatus', $groupement->groupement_id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        @if ($groupement->statut)
            <button type="submit" class="btn-action btn-deactivate" title="Désactiver">
                <i class="bx bx-power-off"></i> Désactiver
            </button>
        @else
            <button type="submit" class="btn-action btn-activate" title="Activer">
                <i class="bx bx-check-circle"></i> Activer
            </button>
        @endif
    </form>
</div>

<style>
.dashboard {
    margin: 3rem 2rem 2rem 17rem;
    width: 1200px;
}

.charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.chart {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(155, 135, 245, 0.1);
    border: 1px solid #f0ecff;
}

.chart h3 {
    color: #6b5d9e;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin: 2rem 2rem 2rem 17rem;
}

.left-panel {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(155, 135, 245, 0.1);
    border: 1px solid #f0ecff;
}

.left-panel h2 {
    color: #9b87f5;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0ecff;
    font-weight: 700;
}

.details p {
    margin: 1rem 0;
    font-size: 1rem;
    color: #4a4a4a;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #faf9ff;
    border-radius: 8px;
}

.details p strong {
    color: #6b5d9e;
    margin-right: 1rem;
}

.right-panel {
    display: grid;
    gap: 2rem;
}

.card {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(155, 135, 245, 0.1);
    border: 1px solid #f0ecff;
}

.card h2 {
    color: #9b87f5;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: #9b87f5;
    color: white;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    margin: 2rem 0 2rem 17rem;
    text-decoration: none;
}

.btn-back:hover {
    background: #8874d4;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(155, 135, 245, 0.3);
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin: 2rem 0 2rem 17rem;
}

.btn-edit, .btn-delete, .btn-action {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-edit {
    background: #9b87f5;
    color: white;
}

.btn-edit:hover {
    background: #8874d4;
    transform: translateY(-1px);
}

.btn-delete {
    background: #ff4757;
    color: white;
}

.btn-delete:hover {
    background: #ff3344;
    transform: translateY(-1px);
}

.btn-activate {
    background: #2ed573;
    color: white;
}

.btn-deactivate {
    background: #ffa502;
    color: white;
}

.content1 .card {
    margin: 2rem 2rem 2rem 17rem;
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(155, 135, 245, 0.1);
    border: 1px solid #f0ecff;
}

/* Chart styling */
.chart canvas {
    max-height: 300px;
}
</style>

<script>
    // Updated Chart Styles
    const effectifCtx = document.getElementById('effectifChart').getContext('2d');
    new Chart(effectifCtx, {
        type: 'bar',
        data: {
            labels: ['Effectif'],
            datasets: [{
                label: 'Effectif',
                data: [{{ $groupement->effectif }}],
                backgroundColor: 'rgba(155, 135, 245, 0.8)',
                borderColor: '#9b87f5',
                borderWidth: 2,
                borderRadius: 12,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { 
                    backgroundColor: '#6b5d9e',
                    titleFont: { size: 14 },
                    bodyFont: { size: 14 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0ecff' }
                }
            }
        }
    });

    const appuiCtx = document.getElementById('appuiChart').getContext('2d');
    new Chart(appuiCtx, {
        type: 'doughnut',
        data: {
            labels: ['Appuis reçus', 'Appuis manquants'],
            datasets: [{
                data: [1, 0],
                backgroundColor: [
                    'rgba(155, 135, 245, 0.8)',
                    'rgba(245, 135, 155, 0.2)'
                ],
                borderColor: '#ffffff',
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: { color: '#6b5d9e' }
                }
            }
        }
    });
</script>
@endsection