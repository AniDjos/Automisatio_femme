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


.content1{
    margin:3rem 2rem 0rem 17rem;
}
/* Tableau de bord */
.dashboard {
    margin: 3rem 2rem 2rem 17rem;
    width: 1200px;
}

.charts {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    width: 100%;
    height: 400px;
}

.chart {
    flex: 1;
    background-color: #f9f9f9;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 50%;
}

/* Contenu principal */
.content {
    display: flex;
    gap: 2rem;
    margin: 5rem 2rem 2rem 17rem;
}

/* Cadre gauche */
.left-panel {
    flex: 1;
    background-color: #f9f9f9;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.content .left-panel h2{
    color:#9b87f5;font-size: 20px;font-weight: bold;
}

.details p {
    margin: 0.5rem 0;
    font-size: 16px;
    color: #333;
}

/* Cadres à droite */
.right-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.card {
    background-color: #f9f9f9;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card h2 {
    margin-bottom: 1rem;
    color:#9b87f5;font-size: 20px;font-weight: bold;
}

/* Bouton retour */
.btn-back {
    display: inline-block;
    margin-top: 2rem;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    background-color: #9b87f5;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background-color: #9b87f5;
}

/* Boutons Modifier et Supprimer */
.action-buttons {
    display: flex;
    gap: 1rem;
    margin-left: 17rem;
    margin-bottom:2rem
}

.btn-edit, .btn-delete {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-edit {
    background-color: #4caf50; 
    margin-top:10px
}

.btn-edit:hover {
    background-color: #45a049;
}

.btn-delete {
    background-color: #f44336;
}

.btn-delete:hover {
    background-color: #e53935;
}

.btn-delete-form {
    display: inline;
}

.btn-action {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 14px;
    font-weight: bold;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-deactivate {
    background-color: #f44336;
}

.btn-deactivate:hover {
    background-color: #e53935;
}

.btn-activate {
    background-color: #4caf50;
}

.btn-activate:hover {
    background-color: #45a049;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique Effectif
    const effectifCtx = document.getElementById('effectifChart').getContext('2d');
    new Chart(effectifCtx, {
        type: 'bar',
        data: {
            labels: ['Effectif'],
            datasets: [{
                label: 'Effectif',
                data: [{{ $groupement->effectif }}],
                backgroundColor: '#9b87f5',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Graphique Répartition des Appuis
    const appuiCtx = document.getElementById('appuiChart').getContext('2d');
    new Chart(appuiCtx, {
        type: 'pie',
        data: {
            labels: ['Appuis reçus', 'Appuis manquants'],
            datasets: [{
                data: [1, 0], // Exemple de données
                backgroundColor: ['#9b87f5', '#f9c74f'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection