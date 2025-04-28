@extends('welcome')

@section('title', 'Dashboard Général')

@section('content')
<style>
/* Variables de couleurs pour faciliter la maintenance */
:root {
    --primary: #8B5CF6;
    --primary-light: #A78BFA;
    --secondary: #F97316;
    --success: #10B981;
    --danger: #EF4444;
    --gray-light: #F3F4F6;
    --gray-medium: #9CA3AF;
    --gray-dark: #4B5563;
    --white: #FFFFFF;
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --transition: all 0.3s ease;
}

.dashboard-container {
    max-width: 1280px;
    margin: 3rem auto 2rem 17rem;
    padding: 2rem;
    background-color: var(--gray-light);
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
}

.dashboard-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2.5rem;
    color: var(--primary);
    position: relative;
    padding-bottom: 1rem;
}

.dashboard-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    border-radius: 2px;
}

/* Animation des conteneurs */
.stats-container,
.charts-container,
.table-container {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.stats-container {
    animation-delay: 0.2s;
}

.charts-container {
    animation-delay: 0.4s;
}

.table-container {
    animation-delay: 0.6s;
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Conteneur des statistiques */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    position: relative;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: var(--shadow-md);
    text-align: center;
    overflow: hidden;
    transition: var(--transition);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--white);
    margin-bottom: 0.75rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.stat-card p {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--white);
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

/* Couleurs pour chaque carte avec gradients améliorés */
.stat-card:nth-child(1) {
    background: linear-gradient(135deg, #4361EE, #3A0CA3);
}

.stat-card:nth-child(2) {
    background: linear-gradient(135deg, #F72585, #7209B7);
}

.stat-card:nth-child(3) {
    background: linear-gradient(135deg, #4CC9F0, #4895EF);
}

.stat-card:nth-child(4) {
    background: linear-gradient(135deg, #F94144, #F3722C);
}

/* Animation des vagues */
.sinusoid {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 40%;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' class='shape-fill'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' class='shape-fill'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' class='shape-fill'%3E%3C/path%3E%3C/svg%3E") no-repeat center center;
    background-size: cover;
    opacity: 0.3;
    pointer-events: none;
}

/* Conteneur des graphiques */
.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.chart-card {
    background: var(--white);
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.chart-card:hover {
    box-shadow: var(--shadow-lg);
}

.chart-card h3 {
    text-align: center;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--gray-dark);
    position: relative;
    padding-bottom: 0.75rem;
}

.chart-card h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    border-radius: 2px;
}

canvas {
    max-width: 100%;
    max-height: 400px;
    display: block;
    margin: 0 auto;
}

/* Tableaux */
.table-container {
    margin-top: 3rem;
    background: var(--white);
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: var(--shadow-md);
}

.table-container h2 {
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: var(--primary);
    position: relative;
    padding-left: 1rem;
}

.table-container h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: var(--primary);
    border-radius: 2px;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 2.5rem;
}

table th,
table td {
    padding: 1rem;
    text-align: left;
    border: none;
}

table th {
    background-color: var(--gray-light);
    font-weight: 600;
    color: var(--gray-dark);
    position: sticky;
    top: 0;
    z-index: 10;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
}

table th:first-child {
    border-top-left-radius: 0.5rem;
}

table th:last-child {
    border-top-right-radius: 0.5rem;
}

table tr:nth-child(even) {
    background-color: rgba(243, 244, 246, 0.5);
}

table tr {
    transition: var(--transition);
}

table tr:hover {
    background-color: rgba(139, 92, 246, 0.05);
}

.action-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.action-link:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 1200px) {
    .dashboard-container {
        margin: 3rem auto 2rem auto;
        padding: 1.5rem;
        width: 95%;
    }
}

@media (max-width: 768px) {
    .chart-card {
        min-height: 400px;
    }

    .stats-container {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}
</style>

<div class="dashboard-container">
    <h1 class="dashboard-title">Tableau de Bord Général</h1>

    <!-- Statistiques résumées -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="sinusoid"></div>
            <h3>Total des Groupements</h3>
            <p>{{ isset($groupementsParDepartement) ? array_sum($groupementsParDepartement->toArray()) : 0 }}</p>
        </div>
        <div class="stat-card">
            <div class="sinusoid"></div>
            <h3>Total des Appuis</h3>
            <p>{{ isset($repartitionAppuis) ? array_sum($repartitionAppuis->toArray()) : 0 }}</p>
        </div>
        <div class="stat-card">
            <div class="sinusoid"></div>
            <h3>Total des Équipements</h3>
            <p>{{ isset($repartitionEquipements) ? array_sum($repartitionEquipements->toArray()) : 0 }}</p>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="charts-container">
        <!-- Graphique 1 : Nombre de groupements par département -->
        <div class="chart-card">
            <h3>Groupements par Département</h3>
            <canvas id="groupementsParDepartement" width="400" height="300"></canvas>
        </div>

        <!-- Graphique 2 : Répartition des Appuis -->
        <div class="chart-card">
            <h3>Répartition des Appuis</h3>
            <canvas id="eautreGraphique" width="400" height="300"></canvas>
        </div>

        <!-- Graphique 3 : État des Équipements -->
        <div class="chart-card">
            <h3>État des Équipements</h3>
            <canvas id="etatEquipements" width="400" height="300"></canvas>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="table-container">
        <!-- Tableau des Groupements -->
        <h2>Groupements</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Effectif</th>
                </tr>
            </thead>
            <tbody>
                @isset($groupements)
                @foreach ($groupements as $groupement)
                <tr>
                    <td>{{ $groupement->groupement_id }}</td>
                    <td>{{ $groupement->nom }}</td>
                    <td>{{ $groupement->effectif }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center">Aucun groupement disponible</td>
                </tr>
                @endisset
            </tbody>
        </table>

        <!-- Tableau des Appuis -->
        <h2>Appuis</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @isset($appuis)
                @foreach ($appuis as $appui)
                <tr>
                    <td>{{ $appui->appuis_id }}</td>
                    <td>{{ $appui->type_appuis }}</td>
                    <td>{{ $appui->description }}</td>
                    <td>{{ $appui->date_appuis }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">Aucun appui disponible</td>
                </tr>
                @endisset
            </tbody>
        </table>

        <!-- Tableau des Équipements -->
        <h2>Équipements</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>État</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @isset($equipements)
                @foreach ($equipements as $equipement)
                <tr>
                    <td>{{ $equipement->id ?? $equipement->equipment_id }}</td>
                    <td>{{ $equipement->nom ?? $equipement->equipment_libelle }}</td>
                    <td>{{ $equipement->etat ?? $equipement->stat_equipement }}</td>
                    <td>{{ $equipement->quantite ?? 'Non spécifié' }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">Aucun équipement disponible</td>
                </tr>
                @endisset
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Définition de la palette de couleurs pour les graphiques
const chartColors = {
    blue: ['#4361EE', '#3A0CA3', '#4895EF', '#4CC9F0'],
    purple: ['#7209B7', '#8B5CF6', '#A78BFA', '#C4B5FD'],
    red: ['#F72585', '#F94144', '#F3722C', '#F8961E'],
    green: ['#06D6A0', '#10B981', '#34D399', '#6EE7B7']
};

// Configuration globale des graphiques
Chart.defaults.font.family = "'Poppins', 'Helvetica', 'Arial', sans-serif";
Chart.defaults.font.size = 13;
Chart.defaults.color = '#4B5563';
Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(17, 24, 39, 0.8)';
Chart.defaults.plugins.tooltip.padding = 12;
Chart.defaults.plugins.tooltip.cornerRadius = 8;
Chart.defaults.plugins.legend.labels.usePointStyle = true;

// Graphique 1 : Groupements par Département
@isset($departements, $groupementsParDepartement)
const ctx1 = document.getElementById('groupementsParDepartement')?.getContext('2d');
if (ctx1) {
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: @json($departements), 
            datasets: [{
                label: 'Nombre de Groupements',
                data: Object.values(@json($groupementsParDepartement)),
                backgroundColor: chartColors.blue,
                borderWidth: 0,
                borderRadius: 6,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: (item) => {
                            const label = item.label || item.chart.data.labels[item
                                .dataIndex]; // Récupère le label correct
                            const value = item.raw; // Récupère la valeur brute
                            const percentage = totalAppuis > 0 ?
                                ((value / totalAppuis) * 100).toFixed(1) :
                                0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: '#E5E7EB',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
}
@endisset

// Graphique 2 : Répartition des Appuis
@isset($typesAppuis, $repartitionAppuis)
const ctx2 = document.getElementById('autreGraphique')?.getContext('2d');
if (ctx2) {
    const repartitionAppuis = @json($repartitionAppuis);
    const totalAppuis = Object.values(repartitionAppuis).reduce((a, b) => a + b, 0);

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: @json($typesAppuis),
            datasets: [{
                data: Object.values(repartitionAppuis),
                backgroundColor: [...chartColors.purple, ...chartColors.red],
                borderWidth: 2,
                borderColor: '#FFFFFF',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: (item) => {
                            const percentage = totalAppuis > 0 ?
                                ((item.raw / totalAppuis) * 100).toFixed(1) :
                                0;
                            return `${item.label}: ${item.formattedValue} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
}
@endisset

// Graphique 3 : État des Équipements
@isset($etatsEquipements, $repartitionEquipements)
const ctx3 = document.getElementById('etatEquipements')?.getContext('2d');
if (ctx3) {
    const repartitionEquipements = @json($repartitionEquipements);
    const totalEquipements = Object.values(repartitionEquipements).reduce((a, b) => a + b, 0);

    new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: @json($etatsEquipements),
            datasets: [{
                data: Object.values(repartitionEquipements),
                backgroundColor: [...chartColors.green, ...chartColors.red],
                borderWidth: 2,
                borderColor: '#FFFFFF',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Assure que le ratio largeur/hauteur est maintenu
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: (item) => {
                            const percentage = totalEquipements > 0 ?
                                ((item.raw / totalEquipements) * 100).toFixed(1) :
                                0;
                            return `${item.label}: ${item.formattedValue} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
}
@endisset

// Animation des vagues sinusoïdales
document.querySelectorAll('.sinusoid').forEach(wave => {
    wave.animate([{
            transform: 'translateX(-10%)'
        },
        {
            transform: 'translateX(0%)'
        },
        {
            transform: 'translateX(10%)'
        },
        {
            transform: 'translateX(0%)'
        },
        {
            transform: 'translateX(-10%)'
        }
    ], {
        duration: 8000,
        iterations: Infinity
    });
});
</script>
@endsection