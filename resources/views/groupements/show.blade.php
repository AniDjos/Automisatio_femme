@extends('welcome')

@section('name', 'Détails du Groupement')

@section('content')
<div class="dashboardd">
    <h1>Tableau de board - {{ $groupement->groupement_nom }}</h1>
    <!--     
    <div class="charts">
        <div class="chart">
            <h3>Effectif</h3>
            <canvas id="effectifChart"></canvas>
        </div>
        <div class="chart">
            <h3>Répartition des Appuis</h3>
            <canvas id="appuiChart"></canvas>
        </div>
    </div> -->
    <div class="dropdown">
        <button class="btn-dropdown">Actions <i class="fas fa-chevron-down"></i></button>
        <div class="dropdown-menu">
            <!-- Retour à la liste -->
            <a href="{{ route('groupements.index') }}" class="dropdown-item">Retour à la liste</a>

            <!-- Modifier -->
            <a href="{{ route('groupements.edit', $groupement->groupement_id) }}" class="dropdown-item">Modifier</a>

            <!-- Supprimer -->
            <form action="{{ route('groupements.destroy', $groupement->groupement_id) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce groupement ?')">Supprimer</button>
            </form>

            <!-- Activer/Désactiver -->
            <form action="{{ route('groupements.toggleStatus', $groupement->groupement_id) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('PUT')
                @if ($groupement->statut)
                <button type="submit" class="dropdown-item">Désactiver</button>
                @else
                <button type="submit" class="dropdown-item">Activer</button>
                @endif
            </form>
        </div>
    </div>
</div>

<div class="content">
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
        @if ($groupement->equipement)
        <p><strong>Nom Equipement :</strong> {{ $groupement->equipement }}</p>
        <p><strong>État Equipement :</strong> {{ $groupement->etat_equipement }}</p>
        <p><strong>Difficulté :</strong> {{ $groupement->description_difficultie }}</p>
        <p><strong>Besoin :</strong> {{ $groupement->description_besoin }}</p>
        @else
        <p>Aucun équipement enregistré.</p>
        @endif
    </div>
</div>

<style>
.dashboardd {
    margin: 4rem 2rem 2rem 17rem;
    width: 1200px;
    display: flex;
    flex-direction: column;
}

.dashboardd h1 {
    color: #9b87f5;
    font-size: 2rem;
    margin-bottom: 2rem;
    font-weight: 700;
    text-align: center;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.btn-dropdown {
    padding: 0.75rem 1.5rem;
    background: green;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-dropdown:hover {
    background: #8874d4;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0 4px 20px rgba(155, 135, 245, 0.1);
    border-radius: 8px;
    padding: 1rem;
    z-index: 1000;
    min-width: 200px;
}

.dropdown-menu .dropdown-item {
    display: block;
    padding: 0.5rem 1rem;
    color: #4a4a4a;
    text-decoration: none;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #f0ecff;
    color: #6b5d9e;
}

.dropdown:hover .dropdown-menu {
    display: block;
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

.right-panel {
    display: grid;
    gap: 2rem;
}

.right-panel h2 {
    color: #9b87f5;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0ecff;
    font-weight: 700;
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
    font-weight: 700;
}

.card p {
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
    align-items: center;
}

.btn-edit,
.btn-delete,
.btn-activate,
.btn-deactivate {
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

.chart canvas {
    max-height: 300px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Effectif Chart (Radar)
new Chart(document.getElementById('effectifChart'), {
    type: 'radar', // Type de diagramme
    data: {
        labels: ['Effectif'], // Étiquettes pour le radar
        datasets: [{
            label: 'Effectif du Groupement',
            data: [{
                {
                    $groupement - > effectif
                }
            }], // Données de l'effectif
            backgroundColor: 'rgba(155, 135, 245, 0.2)', // Couleur de remplissage
            borderColor: 'rgba(155, 135, 245, 1)', // Couleur de la bordure
            borderWidth: 2, // Épaisseur de la bordure
            pointBackgroundColor: 'rgba(155, 135, 245, 1)', // Couleur des points
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top', // Position de la légende
                labels: {
                    color: '#6b5d9e' // Couleur des étiquettes de la légende
                }
            },
            tooltip: {
                backgroundColor: '#6b5d9e',
                titleFont: {
                    size: 14
                },
                bodyFont: {
                    size: 14
                }
            }
        },
        scales: {
            r: {
                angleLines: {
                    color: '#e0e0e0' // Couleur des lignes angulaires
                },
                grid: {
                    color: '#e0e0e0' // Couleur de la grille
                },
                ticks: {
                    backdropColor: 'transparent', // Suppression de l'arrière-plan des ticks
                    color: '#6b5d9e' // Couleur des ticks
                },
                pointLabels: {
                    color: '#6b5d9e', // Couleur des étiquettes des axes
                    font: {
                        size: 14
                    }
                }
            }
        }
    }
});

// Appuis Chart
new Chart(document.getElementById('appuiChart'), {
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
                labels: {
                    color: '#6b5d9e'
                }
            }
        }
    }
});
</script>
@endsection