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
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un groupement par nom, activité, lieu, effectif, localisation...">
                <button type="submit" class="btn-recherche">
                    <span>Rechercher</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
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

                <div class="acronyme-circle">{{ $acronyme }}</div>
                <h2 class="title">{{ $groupement->groupement_nom }}</h2>
            </div>
            <div class="groupement-info">
                <p class="info-item"><i class="fas fa-briefcase"></i> <span>Activité principale : <strong>{{ $groupement->activite_principale ?? 'Non spécifiée' }}</strong></span></p>
                <p class="info-item"><i class="fas fa-users"></i> <span>Effectif : <strong>{{ $groupement->effectif }} membres</strong></span></p>
                <p class="info-item"><i class="fas fa-map-marker-alt"></i> <span>{{ $groupement->departement_nom ?? 'Non spécifié' }} {{ $groupement->commune_nom ?? '' }} {{ $groupement->arrondissement_nom ?? '' }} {{ $groupement->quartier_nom ?? '' }}</span></p>
                <p class="info-item"><i class="fas fa-calendar-alt"></i> <span>Créé le : <strong>{{ $groupement->date_creation }}</strong></span></p>
                <p class="info-item"><i class="fas fa-user"></i> <span>Etat: 
                    @if ($groupement->statut)
                        <span class="badge badge-success">Activé</span>
                    @else
                        <span class="badge badge-danger">Désactivé</span>
                    @endif
                </span></p>
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
            <i class="fas fa-search"></i>
            <p>Aucun groupement trouvé.</p>
            <a href="{{ route('groupements.create') }}" class="btn-create">Créer un groupement</a>
        </div>
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
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                const isOpen = navMenu.classList.contains('active');
                mobileMenuBtn.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });
        }
        
        // For mobile devices, allow opening/closing submenus
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
            }, { threshold: 0.1 });
            
            groupements.forEach(groupement => {
                observer.observe(groupement);
            });
        } else {
            // Fallback for browsers that don't support IntersectionObserver
            groupements.forEach(groupement => {
                groupement.classList.add('visible');
            });
        }
    });
</script>

<style>
    :root {
        --primary: #9b87f5;
        --primary-hover: #7a6ad8;
        --primary-light: rgba(155, 135, 245, 0.1);
        --text: #1A1F2C;
        --text-light: #64748b;
        --white: #ffffff;
        --border: #e5e7eb;
        --bg-light: #f8f9fa;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
        --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        --radius: 0.75rem;
        --radius-sm: 0.5rem;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #3b82f6;
    }

    .content-groupement {
        width: calc(100% - 20rem);
        margin-left: 18rem;
        margin-top: 5rem;
        padding: 0 1.5rem 2rem;
    }

    @media (max-width: 1024px) {
        .content-groupement {
            width: 100%;
            margin-left: 0;
            padding: 0 1rem 2rem;
        }
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .page-header h1 {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text);
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
        letter-spacing: -0.025em;
    }

    /* Recherche section */
    .recherche {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .recherche-groupement {
        display: flex;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .search-wrapper {
        display: flex;
        align-items: center;
        width: 100%;
        position: relative;
        background-color: var(--white);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    
    .search-wrapper:focus-within {
        box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.15);
        border-color: var(--primary);
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        color: var(--text-light);
        font-size: 1rem;
    }
    
    .recherche-groupement input {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.8rem;
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
    
    .btn-recherche {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: white;
        border: none;
        border-radius: 0 var(--radius) var(--radius) 0;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-left: auto;
        white-space: nowrap;
    }
    
    .btn-recherche:hover {
        background: linear-gradient(135deg, #8a78df, #6a5cc8);
    }
    
    .btn-ajout .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: var(--white);
        padding: 0.8rem 1.5rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        border: none;
        cursor: pointer;
    }

    .btn-ajout .btn:hover {
        background: linear-gradient(135deg, #8a78df, #6a5cc8);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    /* Grille de groupements */
    .container-prin {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.75rem;
        margin-top: 1rem;
    }

    @media (max-width: 640px) {
        .container-prin {
            grid-template-columns: 1fr;
        }
    }

    .container-groupement {
        background-color: var(--white);
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
    }
    
    .container-groupement.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .container-groupement:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .header-groupement {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        gap: 1rem;
    }

    .acronyme-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 50%;
        flex-shrink: 0;
        box-shadow: 0 0 10px rgba(155, 135, 245, 0.3);
    }

    .header-groupement .title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text);
        margin: 0;
        flex-grow: 1;
    }

    .badge {
        display: inline-block;
        padding: 0.3rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.15);
        color: var(--success);
    }

    .badge-danger {
        background-color: rgba(239, 68, 68, 0.15);
        color: var(--danger);
    }
    
    .groupement-info {
        flex-grow: 1;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin: 0.9rem 0;
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.5;
    }

    .info-item i {
        font-size: 1rem;
        color: var(--primary);
        min-width: 1rem;
        margin-top: 0.15rem;
    }

    .info-item strong {
        font-weight: 600;
        color: var(--text);
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
        padding: 0.6rem 1.2rem;
        background-color: var(--primary-light);
        color: var(--primary);
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .detail-link:hover {
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: white;
        box-shadow: var(--shadow-sm);
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
        gap: 1rem;
    }

    .empty-message i {
        font-size: 3rem;
        color: var(--text-light);
        opacity: 0.5;
    }

    .empty-message p {
        font-size: 1.125rem;
        font-weight: 500;
        color: var(--text);
        margin: 0;
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #9b87f5, #7a6ad8);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    /* Animations */
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

    .page-header {
        animation: slideIn 0.5s ease-out;
    }

    .recherche {
        animation: fadeIn 0.6s ease-out;
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
