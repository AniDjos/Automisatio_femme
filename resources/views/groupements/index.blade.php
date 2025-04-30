@extends('welcome')

@section('name', 'Groupements')

@section('content')
    <main class="content-groupement">
        <div class="page-header">
            <h1>Groupements</h1>
            <div class="btn-ajout">
                <a href="{{ route('groupements.create') }}" class="btn">
                    <i class="fas fa-plus"></i>
                    <span>Nouveau groupement</span>
                </a>
            </div>
        </div>

        <!-- Formulaire de recherche -->
        <div class="recherche">
            <form action="{{ route('groupements.index') }}" method="GET" class="recherche-groupement">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" id="searchGroupement" value="{{ request('search') }}"
                        placeholder="Rechercher un groupement par nom, activité, lieu, effectif, localisation...">
                </div>

                <!-- Champs de sélection pour les filtres -->
                <div class="filter-wrapper">
                    <div class="select-container">
                        <select name="departement" id="departement" class="filter-select">
                            <option value="">-- Sélectionner un département --</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->departement_id }}">{{ $departement->departement_libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="select-container">
                        <select name="commune" id="commune" class="filter-select">
                            <option value="">-- Sélectionner une commune --</option>
                        </select>
                    </div>

                    <div class="select-container">
                        <select name="arrondissement" id="arrondissement" class="filter-select">
                            <option value="">-- Sélectionner un arrondissement --</option>
                        </select>
                    </div>

                    <div class="select-container">
                        <select name="quartier" id="quartier" class="filter-select">
                            <option value="">-- Sélectionner un quartier --</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-recherche">
                    <span>Rechercher</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <!-- Liste des groupements -->
        <div class="container-prin">
            @forelse($groupements as $groupement)
                <div class="container-groupement" data-name="{{ strtolower($groupement->groupement_nom) }}">
                    <div class="header-groupement">
                        <!-- Génération de l'acronyme -->
                        @php
                            $acronyme = implode(
                                '',
                                array_map(function ($word) {
                                    return strtoupper($word[0]);
                                }, explode(' ', $groupement->groupement_nom)),
                            );
                        @endphp

                        <div class="acronyme-circle">
                            <span>{{ $acronyme }}</span>
                            <div class="circle-glow"></div>
                        </div>
                        <h2 class="title">{{ $groupement->groupement_nom }}</h2>
                    </div>
                    <div class="groupement-info">
                        <p class="info-item" data-tooltip="Activité principale du groupement">
                            <i class="fas fa-briefcase"></i>
                            <span>Activité principale :
                                <strong>{{ $groupement->activite_principale ?? 'Non spécifiée' }}</strong></span>
                        </p>
                        <p class="info-item" data-tooltip="Nombre total de membres">
                            <i class="fas fa-users"></i>
                            <span>Effectif : <strong>{{ $groupement->effectif }} membres</strong></span>
                        </p>
                        <p class="info-item" data-tooltip="Emplacement du groupement">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $groupement->departement_nom ?? 'Non spécifié' }}
                                {{ $groupement->commune_nom ?? '' }} {{ $groupement->arrondissement_nom ?? '' }}
                                {{ $groupement->quartier_nom ?? '' }}</span>
                        </p>
                        <p class="info-item" data-tooltip="Date de création du groupement">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Créé le : <strong>{{ $groupement->date_creation }}</strong></span>
                        </p>
                        <p class="info-item" data-tooltip="État actuel du groupement">
                            <i class="fas fa-user"></i>
                            <span>Etat:
                                @if ($groupement->rejet)
                                    <span class="badge badge-danger">Rejeté</span>
                                @elseif ($groupement->statut)
                                    <span class="badge badge-success">Activé</span>
                                @else
                                    <span class="badge badge-warning">Désactivé</span>
                                @endif
                            </span>
                        </p>
                    </div>
                    <div class="groupement-description">
                        <a href="{{ route('groupements.show', $groupement->groupement_id) }}" class="detail-link">
                            <span>Voir détails</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-message">
                    <div class="empty-icon-container">
                        <i class="fas fa-search"></i>
                    </div>
                    <p>Aucun groupement trouvé.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $groupements->links() }}
        </div>
    </main>

    <!-- JavaScript pour Mobile Menu et animations -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchGroupement');
            const groupements = document.querySelectorAll('.container-groupement');

            // Fonction pour filtrer les groupements
            function filterGroupements(query) {
                const lowerCaseQuery = query.toLowerCase();

                groupements.forEach(groupement => {
                    const groupementName = groupement.getAttribute('data-name');

                    // Vérifier si le nom du groupement correspond à la recherche
                    if (groupementName.includes(lowerCaseQuery)) {
                        groupement.style.display = ''; // Afficher le groupement
                    } else {
                        groupement.style.display = 'none'; // Masquer le groupement
                    }
                });
            }

            // Écouteur d'événement sur l'input de recherche
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                filterGroupements(query);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du menu mobile
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navMenu = document.getElementById('navMenu');
            const navItems = document.querySelectorAll('.nav-item');

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                    const isOpen = navMenu.classList.contains('active');
                    mobileMenuBtn.innerHTML = isOpen ? '<i class="fas fa-times"></i>' :
                        '<i class="fas fa-bars"></i>';
                });
            }

            if (window.innerWidth <= 768) {
                navItems.forEach(item => {
                    const link = item.querySelector('.nav-link');
                    if (link) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            item.classList.toggle('active');
                        });
                    }
                });
            }

            // Animation des cartes au chargement
            setTimeout(() => {
                document.querySelectorAll('.container-groupement').forEach((el, index) => {
                    setTimeout(() => {
                        el.classList.add('visible');
                    }, 100 * index);
                });
            }, 300);

            // Animation on scroll
            const groupements = document.querySelectorAll('.container-groupement');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1
                });

                groupements.forEach(groupement => {
                    observer.observe(groupement);
                });
            } else {
                groupements.forEach(groupement => {
                    groupement.classList.add('visible');
                });
            }

            // Ajout de l'effet de survol pour les infobulles
            document.querySelectorAll('.info-item[data-tooltip]').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.textContent = this.getAttribute('data-tooltip');
                    document.body.appendChild(tooltip);

                    const rect = this.getBoundingClientRect();
                    tooltip.style.top =
                        `${rect.top - tooltip.offsetHeight - 10 + window.scrollY}px`;
                    tooltip.style.left =
                        `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;

                    setTimeout(() => tooltip.classList.add('visible'), 10);

                    this.addEventListener('mouseleave', function handler() {
                        tooltip.classList.remove('visible');
                        setTimeout(() => document.body.removeChild(tooltip), 200);
                        this.removeEventListener('mouseleave', handler);
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departementSelect = document.getElementById('departement');
            const communeSelect = document.getElementById('commune');
            const arrondissementSelect = document.getElementById('arrondissement');
            const quartierSelect = document.getElementById('quartier');

            // Fonction pour vider un champ select
            function clearSelect(selectElement) {
                selectElement.innerHTML = '<option value="">-- Sélectionner --</option>';
            }

            // Charger les communes en fonction du département sélectionné
            departementSelect.addEventListener('change', function() {
                const departementId = this.value;
                clearSelect(communeSelect);
                clearSelect(arrondissementSelect);
                clearSelect(quartierSelect);

                if (departementId) {
                    fetch(`/communes/${departementId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(commune => {
                                const option = document.createElement('option');
                                option.value = commune.commune_id;
                                option.textContent = commune.commune_libelle;
                                communeSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Erreur lors du chargement des communes:', error));
                }
            });

            // Charger les arrondissements en fonction de la commune sélectionnée
            communeSelect.addEventListener('change', function() {
                const communeId = this.value;
                clearSelect(arrondissementSelect);
                clearSelect(quartierSelect);

                if (communeId) {
                    fetch(`/arrondissements/${communeId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(arrondissement => {
                                const option = document.createElement('option');
                                option.value = arrondissement.arrondissement_id;
                                option.textContent = arrondissement.arrondissement_libelle;
                                arrondissementSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Erreur lors du chargement des arrondissements:',
                            error));
                }
            });

            // Charger les quartiers en fonction de l'arrondissement sélectionné
            arrondissementSelect.addEventListener('change', function() {
                const arrondissementId = this.value;
                clearSelect(quartierSelect);

                if (arrondissementId) {
                    fetch(`/quartiers/${arrondissementId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(quartier => {
                                const option = document.createElement('option');
                                option.value = quartier.quartier_id;
                                option.textContent = quartier.quartier_libelle;
                                quartierSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Erreur lors du chargement des quartiers:', error));
                }
            });
        });
    </script>

    <style>
        :root {
            --primary: #9b87f5;
            --primary-hover: #7a6ad8;
            --primary-light: rgba(155, 135, 245, 0.1);
            --primary-light-hover: rgba(155, 135, 245, 0.2);
            --primary-transparent: rgba(155, 135, 245, 0.04);
            --text: #1A1F2C;
            --text-light: #64748b;
            --white: #ffffff;
            --border: #e5e7eb;
            --bg-light: #f8f9fa;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            --radius: 1rem;
            --radius-sm: 0.5rem;
            --radius-full: 9999px;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --font-sans: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            --transition-fast: 0.2s ease;
            --transition: 0.3s ease;
            --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Base styles */
        .content-groupement {
            width: calc(100% - 20rem);
            margin-left: 18rem;
            margin-top: 5rem;
            padding: 2rem;
            font-family: var(--font-sans);
            color: var(--text);
            background-color: var(--bg-light);
            min-height: calc(100vh - 5rem);
        }

        @media (max-width: 1024px) {
            .content-groupement {
                width: 100%;
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        /* Header section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(155, 135, 245, 0.2);
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), transparent);
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text);
            margin: 0;
            letter-spacing: -0.025em;
            position: relative;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        .page-header h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), transparent);
            border-radius: var(--radius-full);
        }

        /* Buttons */
        .btn-ajout .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            color: var(--white);
            padding: 0.85rem 1.75rem;
            border-radius: var(--radius-full);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(155, 135, 245, 0.3);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-ajout .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #8a78df, #6a5cc8);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .btn-ajout .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
        }

        .btn-ajout .btn:hover::before {
            opacity: 1;
        }

        .btn-ajout .btn:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(155, 135, 245, 0.3);
        }

        .btn-ajout .btn i {
            font-size: 0.9rem;
        }

        /* Search section */
        .recherche {
            margin-bottom: 2.5rem;
            position: relative;
            padding: 1.5rem;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .recherche-groupement {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
            position: relative;
            background-color: var(--bg-light);
            border-radius: var(--radius-full);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .search-wrapper:focus-within {
            box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            color: var(--primary);
            font-size: 1rem;
        }

        .recherche-groupement input {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3.2rem;
            font-size: 0.95rem;
            border: none;
            background: transparent;
            color: var(--text);
        }

        .recherche-groupement input:focus {
            outline: none;
        }

        .recherche-groupement input::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Filter section */
        .filter-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
            width: 100%;
        }

        .select-container {
            position: relative;
            width: 100%;
        }

        .filter-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 0.9rem;
            z-index: 2;
        }

        .arrow-icon {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 0.8rem;
            pointer-events: none;
            transition: transform 0.2s ease;
        }

        .filter-select:focus+.arrow-icon {
            transform: translateY(-50%) rotate(180deg);
            color: var(--primary);
        }

        .filter-select {
            width: 100%;
            padding: 0.85rem 2.5rem 0.85rem 3rem;
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            background-color: var(--bg-light);
            font-size: 0.9rem;
            color: var(--text);
            appearance: none;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
        }

        .btn-recherche {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.95rem 2rem;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
            align-self: center;
            box-shadow: 0 4px 12px rgba(155, 135, 245, 0.3);
            width: auto;
            min-width: 200px;
        }

        .btn-recherche:hover {
            background: linear-gradient(135deg, #8a78df, #6a5cc8);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
        }

        .btn-recherche:active {
            transform: translateY(0);
        }

        .btn-recherche i {
            transition: transform 0.3s ease;
        }

        .btn-recherche:hover i {
            transform: translateX(4px);
        }

        /* Groupements Grid */
        .container-prin {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        @media (max-width: 640px) {
            .container-prin {
                grid-template-columns: 1fr;
            }
        }

        .container-groupement {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.4s ease;
            border: 1px solid var(--border);
            height: 100%;
            opacity: 0;
            transform: translateY(20px);
            position: relative;
            overflow: hidden;
        }

        .container-groupement::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #9b87f5, #7a6ad8);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .container-groupement.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .container-groupement:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .container-groupement:hover::before {
            transform: scaleX(1);
        }

        /* Header groupement */
        .header-groupement {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
            gap: 1rem;
            position: relative;
        }

        .acronyme-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(155, 135, 245, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .circle-glow {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
            animation: rotate 8s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .header-groupement .title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            flex-grow: 1;
            line-height: 1.3;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.35rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Info */
        .groupement-info {
            flex-grow: 1;
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin: 1rem 0;
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.6;
            position: relative;
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-sm);
            transition: background-color var(--transition-fast);
            cursor: default;
        }

        .info-item:hover {
            background-color: var(--primary-transparent);
        }

        .info-item i {
            font-size: 1rem;
            color: var(--primary);
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-light);
            border-radius: 50%;
            flex-shrink: 0;
            transition: all var(--transition-fast);
        }

        .info-item:hover i {
            background-color: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .info-item strong {
            font-weight: 600;
            color: var(--text);
        }

        /* Description */
        .groupement-description {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: var(--radius-full);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .detail-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            z-index: -1;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .detail-link:hover {
            color: white;
        }

        .detail-link:hover::before {
            transform: scaleX(1);
        }

        .detail-link:hover i {
            transform: translateX(4px);
        }

        .detail-link i {
            transition: transform 0.3s ease;
        }

        /* Empty state */
        .empty-message {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px dashed var(--border);
            gap: 1.5rem;
        }

        .empty-icon-container {
            width: 5rem;
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            border-radius: 50%;
            margin-bottom: 0.5rem;
        }

        .empty-message i {
            font-size: 2.5rem;
            color: var(--primary);
            opacity: 0.8;
        }

        .empty-message p {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
            margin: 0;
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, #9b87f5, #7a6ad8);
            color: white;
            padding: 0.85rem 1.75rem;
            border-radius: var(--radius-full);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(155, 135, 245, 0.3);
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(155, 135, 245, 0.4);
        }

        .btn-create:active {
            transform: translateY(0);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 1.5rem;
        }

        /* Tooltip styles */
        .tooltip {
            position: absolute;
            background: var(--text);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.2s ease;
            pointer-events: none;
            z-index: 100;
            box-shadow: var(--shadow);
            text-align: center;
            max-width: 280px;
        }

        .tooltip::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid var(--text);
        }

        .tooltip.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(155, 135, 245, 0.6);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(155, 135, 245, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(155, 135, 245, 0);
            }
        }

        /* Media queries */
        @media (min-width: 768px) {
            .recherche-groupement {
                flex-direction: row;
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .search-wrapper {
                flex: 1 1 100%;
                margin-bottom: 1rem;
            }

            .filter-wrapper {
                flex: 1 1 calc(100% - 220px);
                margin-right: 1rem;
            }

            .btn-recherche {
                margin-top: 0;
                height: fit-content;
                align-self: flex-start;
                white-space: nowrap;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .filter-wrapper {
                grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
            }

            .container-groupement {
                padding: 1.5rem;
            }

            .acronyme-circle {
                width: 3rem;
                height: 3rem;
                font-size: 1.1rem;
            }

            .header-groupement .title {
                font-size: 1.2rem;
            }
        }

        @media print {
            .content-groupement {
                width: 100%;
                margin: 0;
                padding: 1rem;
            }

            .btn-ajout,
            .recherche,
            .detail-link {
                display: none;
            }

            .container-prin {
                grid-template-columns: repeat(2, 1fr);
            }

            .container-groupement {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection
