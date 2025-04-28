@extends('welcome')

@section('name', 'Groupements')

@section('content')
<main class="content-groupement">
    <div class="page-header">
        <h1>Groupements</h1>
        <div class="btn-ajout">
            <a href="{{ route('groupements.create') }}" class="btn">
                <i class="fas fa-plus"></i>
                Nouveau groupement
            </a>
        </div>
    </div>

    <!-- Formulaire de recherche -->
    <div class="recherche">
        <form action="{{ route('groupements.index') }}" method="GET" class="recherche-groupement">
            <div style="display: flex; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un groupement par nom, activité, lieu, effectif...">
            <button type="submit" class="btn-recherche">Rechercher</button>
            </div>
        </form>
    </div>

    <!-- Liste des groupements -->
    <div class="container-prin">
        @forelse($groupements as $groupement)
        <div class="container-groupement">
            <div class="header-groupement">
                <!-- Génération de l'acronyme -->
                @php
                    $acronyme = implode('', array_map(function($word) {
                        return strtoupper($word[0]);
                    }, explode(' ', $groupement->groupement_nom)));
                @endphp

                <h2 class="title"> <span class="acronyme-circle">{{ $acronyme }}</span>{{ $groupement->groupement_nom }}</h2>
                <span class="status-badge">Actif</span>
            </div>
            <div>
                <p><i class="fas fa-briefcase"></i> Activité principale : {{ $groupement->activite_principale ?? 'Non spécifiée' }}</p>
                <p><i class="fas fa-users"></i> Effectif : {{ $groupement->effectif }} membres</p>
                <p><i class="fas fa-map-marker-alt"></i>{{ $groupement->departement_nom ?? 'Non spécifié' }} {{ $groupement->commune_nom ?? 'Non spécifiée' }} {{ $groupement->localite_nom ?? 'Non spécifiée' }}</p>
                <p><i class="fas fa-calendar-alt"></i> Créé le : {{ $groupement->date_creation }}</p>
            </div>
            <div class="groupement-description">
                <a href="{{ route('groupements.show', $groupement->id) }}" class="detail-link">
                    Voir détails
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <p>Aucun groupement trouvé.</p>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="pagination-container">
        {{ $groupements->links() }}
    </div>
</main>

<!-- JavaScript for Mobile Menu -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');
        const navItems = document.querySelectorAll('.nav-item');
        
        // Toggle mobile menu
        mobileMenuBtn.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            const isOpen = navMenu.classList.contains('active');
            mobileMenuBtn.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars'></i>';
        });
        
        // For mobile devices, allow opening/closing submenus
        if (window.innerWidth <= 768) {
            navItems.forEach(item => {
                const link = item.querySelector('.nav-link');
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    item.classList.toggle('active');
                });
            });
        }
    });
</script>
@endsection

<style>
    .content-groupement{
        width: calc(100% - 20rem);
        margin-left: 18rem;
        margin-top: 5rem;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text);
        background: linear-gradient(to right, #1e293b, #334155);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Recherche section */
    .recherche {
        display: flex;
        justify-content: center;
        width: 100%;
        align-items: center;
        margin-bottom: 20px;
    }

    
    .recherche-groupement {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }
    
    .recherche-groupement input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .btn-recherche {
        padding: 10px 20px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-recherche:hover {
        background-color: #0056b3;
    }
    .btn-ajout .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: var(--primary);
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: none;
        cursor: pointer;
    }

    .btn-ajout .btn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Grille de groupements */
    .container-prin {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .container-groupement {
        background-color: var(--white);
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease;
        border: 1px solid var(--border);
        height: 100%;
    }

    .container-groupement:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .header-groupement {
        text-align: center;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .header-groupement .title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background-color: #10b981;
        color: white;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .container-groupement p {
        font-size: 1rem;
        color: var(--text);
        margin: 0.75rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .container-groupement p i {
        font-size: 1.1rem;
        color: var(--primary);
        min-width: 1.1rem;
        text-align: center;
    }

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
        padding: 0.5rem 1rem;
        background-color: var(--primary-light);
        color: var(--primary);
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .detail-link:hover {
        background-color: var(--primary);
        color: white;
    }

    .pagination-container {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
</style>