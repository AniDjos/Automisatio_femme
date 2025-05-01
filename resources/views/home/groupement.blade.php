@extends('welcome')

@section('name', 'Accueil')

@section('content')
<div class="page-header">
    <h1>Liste des groupements</h1>
    <p class="subtitle">Découvrez les différents groupements disponibles et explorez leurs activités</p>
</div>

<div class="groupement-container">
    @foreach($groupements as $groupement)
        <div class="groupement-card">
            <div class="groupement-header" style="background-color: #e3dc17;">
                <div class="groupement-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 14v1"/><path d="M9 8v3"/><path d="M15 11v4"/><path d="M15 8v1"/><path d="M9 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/><path d="M15 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/></svg>
                </div>
                <div class="groupement-acronym">
                    {{ strtoupper(substr($groupement->groupement_nom, 0, 1)) }}{{ strtoupper(substr(strrchr($groupement->groupement_nom, ' ') ?: $groupement->nom, 1, 1)) }}
                </div>
            </div>
            <div class="groupement-body">
                <h3 class="groupement-name">{{ $groupement->groupement_nom }}</h3>
                <div class="groupement-info">
                    @if(isset($groupement->departement_nom))
                        <span class="groupement-tag">{{ $groupement->departement_nom }}</span>
                    @endif
                    @if(isset($groupement->commune_nom))
                        <span class="groupement-tag">{{ $groupement->commune_nom }}</span>
                    @endif
                    @if(isset($groupement->arrondissement_nom))
                        <span class="groupement-tag">{{ $groupement->arrondissement_nom }}</span>
                    @endif
                    @if(isset($groupement->activite_principale_nom))
                        <span class="groupement-members">{{ $groupement->activite_principale_nom }} membres</span>
                    @endif
                </div>
                <a href="{{ route('App_groupement_shows', $groupement->groupement_id) }}" class="details-button">
                    Voir détails
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    @endforeach
</div>

<style>
    body {
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }
    
    body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.94);
        z-index: -1;
    }
    
    .page-header {
        text-align: center;
        margin: 6rem 0 3rem;
        padding: 0 1rem;
    }
    
    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1A1F2C;
        margin-bottom: 0.5rem;
        position: relative;
        margin-top:4rem;
        display: inline-block;
    }
    
    .page-header h1::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        width: 60px;
        height: 4px;
        background-color: #e3dc17;
        transform: translateX(-50%);
        border-radius: 4px;
    }
    
    .subtitle {
        font-size: 1.1rem;
        color: #6B7280;
        max-width: 600px;
        margin: 1.5rem auto 0;
    }

    .groupement-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        padding: 1rem 2rem 4rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .groupement-card {
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(229, 231, 235, 0.7);
    }
    
    .groupement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .groupement-header {
        position: relative;
        height: 130px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .groupement-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 42px;
        height: 42px;
        opacity: 0.6;
    }
    
    .groupement-acronym {
        font-size: 3.5rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .groupement-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .groupement-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #374151;
        margin: 0 0 0.8rem;
        line-height: 1.3;
    }
    
    .groupement-info {
        display: flex;
        align-items: center;
        margin-bottom: 1.2rem;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .groupement-tag {
        background-color: #F5F2FF;
        color: #e3dc17;
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 12px;
        font-weight: 500;
    }
    
    .groupement-members {
        color: #6B7280;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
    }
    
    .groupement-members::before {
        content: '•';
        margin-right: 6px;
        color: #e3dc17;
    }
    
    .details-button {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #F5F2FF;
        color:rgb(12, 12, 12);
        font-weight: 500;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .details-button:hover {
        background-color: #e3dc17;
        color: white;
    }
    
    @media (max-width: 768px) {
        .groupement-container {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            padding: 1rem;
        }
        
        .page-header {
            margin: 5rem 0 2rem;
        }
        
        .page-header h1 {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 480px) {
        .groupement-container {
            grid-template-columns: 1fr;
            padding: 0.5rem;
        }
    }
</style>
@endsection
