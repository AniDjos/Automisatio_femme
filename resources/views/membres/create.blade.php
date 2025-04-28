@extends('welcome')

@section('name', 'Création d\'un Membre')

@section('content')
<style>
    .container-print {
        width: 55%;
        margin: 10rem 0rem 3rem 30rem;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .container-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px rgba(155, 135, 245, 0.15);
    }

    .container-print h1 {
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        color: #1A1F2C;
        font-weight: 600;
        border-bottom: 2px solid #E5DEFF;
        padding-bottom: 0.8rem;
    }

    .form-membre {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 0.5rem;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #403E43;
        font-size: 0.95rem;
        letter-spacing: 0.02rem;
    }

    .form-group input,
    .form-group select {
        padding: 0.8rem 1rem;
        border: 1px solid #E5DEFF;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #F6F6F7;
        transition: all 0.25s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #9b87f5;
        outline: none;
        box-shadow: 0 0 0 3px rgba(155, 135, 245, 0.2);
        background-color: #ffffff;
    }

    .form-group input::placeholder {
        color: #8A898C;
        opacity: 0.7;
    }
    
    .btn-submit-container {
        grid-column: 1 / -1;
        margin-top: 1rem;
        display: flex;
        justify-content: flex-end;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.8rem 2rem;
        font-size: 1rem;
        font-weight: 500;
        color: #fff;
        background-color: #9b87f5;
        border: 2px solid #9b87f5;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-submit:hover {
        background-color: #7E69AB;
        border-color: #7E69AB;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(155, 135, 245, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(155, 135, 245, 0.3);
    }

    @media (max-width: 768px) {
        .container-print {
            width: 95%;
            margin: 2rem auto;
            padding: 1.5rem;
        }
        
        .form-membre {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-print">
    <h1>Créer un Membre</h1>
    <form action="{{ route('membres.store') }}" method="POST" class="form-membre">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du Membre</label>
            <input type="text" id="nom" name="nom_membre" placeholder="Entrez le nom du membre" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom du Membre</label>
            <input type="text" id="prenom" name="prenom_membre" placeholder="Entrez le prénom du membre" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role_stimule" required>
                <option value="" disabled selected>Choisissez un rôle</option>
                <option value="Présidente">Présidente</option>
                <option value="Secrétaire">Secrétaire</option>
                <option value="Personnel simple">Membre</option>
                <option value="Personnel simple">Trésorière</option>
            </select>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Entrez le numéro de téléphone" required>
        </div>

        <div class="form-group">
            <label for="groupement_id">Groupement</label>
            <select id="groupement_id" name="groupement_id" required>
                <option value="" disabled selected>Choisissez un groupement</option>
                @foreach($groupements as $groupement)
                    <option value="{{ $groupement->groupement_id }}">{{ $groupement->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group btn-submit-container">
            <button type="submit" class="btn-submit">Créer le Membre</button>
        </div>
    </form>
</div>
@endsection
