@extends('welcome')

@section('name', 'Dashboard Général')

@section('content')
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 4rem 0rem 2rem 17rem;
            padding: 1rem;
        }

        .dashboard-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #9b87f5;
        }

        .stats-container, .charts-container, .table-container {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.9s ease forwards;
        }

        .stats-container {
            animation-delay: 0.3s;
        }

        .charts-container {
            animation-delay: 0.6s;
        }

        .table-container {
            animation-delay: 0.9s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            position: relative;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        .stat-card h3 {
            font-size: 18px;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        /* Couleurs pour chaque carte */
        .stat-card:nth-child(1) {
            background: linear-gradient(135deg, #4a90e2, #6fb1fc);
        }

        .stat-card:nth-child(2) {
            background: linear-gradient(135deg, #f9c74f, #f9844a);
        }

        .stat-card:nth-child(3) {
            background: linear-gradient(135deg, #90be6d, #43aa8b);
        }

        .stat-card:nth-child(4) {
            background: linear-gradient(135deg, #f94144, #f3722c);
        }

        /* Animation sinusoïdale */
        .sinusoid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            animation: moveSinusoid 3s infinite linear;
            pointer-events: none;
        }


        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .chart-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-card h3 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 1rem;
            color: #555;
        }

        canvas {
            max-width: 100%;
            height: 300px;
        }

        .table-container {
            margin-top: 3rem;
        }

        .table-container h2{
            font-weight:bolder;
            font-size: 20px;
            margin-bottom: 1rem;   
            color:#9b87f5 ;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        table th, table td {
            padding: 0.75rem;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .action-link {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
        }

        .action-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Tableau de Bord Général</h1>

        <!-- Statistiques résumées -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="sinusoid"></div>
                <h3>Total des Groupements</h3>
                <p>{{ array_sum($groupementsParDepartement->toArray()) }}</p>
            </div>
            <div class="stat-card">
                <div class="sinusoid"></div>
                <h3>Total des Appuis</h3>
                <p>{{ array_sum($repartitionAppuis->toArray()) }}</p>
            </div>
            <div class="stat-card">
                <div class="sinusoid"></div>
                <h3>Total des Équipements</h3>
                <p>{{ array_sum($repartitionEquipements->toArray()) }}</p>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="charts-container">
            <!-- Graphique 1 : Nombre de groupements par département -->
            <div class="chart-card">
                <h3>Groupements par Département</h3>
                <canvas id="groupementsParDepartement"></canvas>
            </div>

            <!-- Graphique 2 : Répartition des Appuis -->
            <div class="chart-card">
                <h3>Répartition des Appuis</h3>
                <canvas id="repartitionAppuis"></canvas>
            </div>

            <!-- Graphique 3 : État des Équipements -->
            <div class="chart-card">
                <h3>État des Équipements</h3>
                <canvas id="etatEquipements"></canvas>
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
                    @foreach ($groupements as $groupement)
                        <tr>
                            <td>{{ $groupement->groupement_id }}</td>
                            <td>{{ $groupement->nom }}</td>
                            <td>{{ $groupement->effectif }}</td>
                        </tr>
                    @endforeach
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
                    @foreach ($appuis as $appui)
                        <tr>
                            <td>{{ $appui->appuis_id }}</td>
                            <td>{{ $appui->type_appuis }}</td>
                            <td>{{ $appui->description }}</td>
                            <td>{{ $appui->date_appuis }}</td>
                        </tr>
                    @endforeach
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
                    @foreach ($equipements as $equipement)
                        <tr>
                        <td>{{ $equipement->id ?? $equipement->equipment_id }}</td>
                <td>{{ $equipement->nom ?? $equipement->equipment_libelle }}</td>
                <td>{{ $equipement->etat ?? $equipement->stat_equipement }}</td>
                <td>{{ $equipement->quantite ?? 'Non spécifié' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données dynamiques injectées depuis le contrôleur
        const departements = @json($departements);
        const groupementsParDepartement = @json($groupementsParDepartement);

        const typesAppuis = @json($typesAppuis);
        const repartitionAppuis = @json($repartitionAppuis);

        const etatsEquipements = @json($etatsEquipements);
        const repartitionEquipements = @json($repartitionEquipements);

        const revenusMensuels = @json($revenusMensuels);

        // Graphique 1 : Groupements par Département
        const ctx1 = document.getElementById('groupementsParDepartement').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: departements,
                datasets: [{
                    label: 'Nombre de Groupements',
                    data: Object.values(groupementsParDepartement),
                    backgroundColor: '#4a90e2',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Graphique 2 : Répartition des Appuis
        const ctx2 = document.getElementById('repartitionAppuis').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: typesAppuis,
                datasets: [{
                    data: Object.values(repartitionAppuis),
                    backgroundColor: ['#f9c74f', '#f9c74f', '#90be6d'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Graphique 3 : État des Équipements
        const ctx3 = document.getElementById('etatEquipements').getContext('2d');
        new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: etatsEquipements,
                datasets: [{
                    data: Object.values(repartitionEquipements),
                    backgroundColor: ['#4a90e2', '#90be6d', '#f3722c'],
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