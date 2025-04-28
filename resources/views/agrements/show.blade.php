@extends('welcome')

@section('name', 'Détails de l\'Agrément')

@section('content')
<div class="containerer">
    <h1 class="page-title">Détails de l'Agrément</h1>

    <div class="card">
        <div class="card-header">
            <h3></h3>
        </div>
        <div class="document">
            <div class="file">
                @if(file_exists(public_path('agrements/' . $agrement->document)))
                <img src="{{ asset('images/doc.png') }}" alt="">
                <a href="{{ asset('agrements/' . $agrement->document) }}" target="_blank" class="btn-link">
                    <i class='bx bxs-download'></i> Télécharger le document
                </a>
                @else
                <p>Le document n'est pas disponible.</p>
                @endif
            </div>
            <div class="card-body">
                <p><strong>Structure :</strong> {{ $agrement->structure }}</p>
                <p><strong>Référence :</strong> {{ $agrement->reference }}</p>
                <p><strong>Date de Livraison :</strong> {{ $agrement->date_deliver }}</p>
                <p><strong>Groupement :</strong> {{ $agrement->groupement->nom ?? 'Non spécifié' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('agrement.index') }}" class="btn-create">Retour à la liste</a>
        <a href="{{ route('agrement.edit', $agrement->agrement_id) }}" class="btn-edit">Modifier</a>
        <form action="{{ route('agrement.destroy', $agrement->agrement_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agrément ?')">Supprimer</button>
        </form>
    </div>
</div>

<style>
.containerer {
    max-width: 1200px;
    margin: 5rem 2rem 2rem 17rem;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.document {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.file {
    width: 50%;
    margin-right: 1rem;
    border-radius: 8px;
    padding: 1rem;
    background-color: #f0f0f0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.file a {
    text-align: center;
    color: #9b87f5;
}

.file img {
    width: 500px;
    height: 400px;
}

.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #9b87f5;
}

.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    background-color: #fff;
    margin-bottom: 1.5rem;
}

.card-body {
    width: 50%;
    margin-left: 5rem;
}

.card-header h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
}

.card-body p {
    margin: 0.5rem 0;
    font-size: 16px;
    color: #555;
}

.btn-create,
.btn-edit,
.btn-delete {
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

.btn-create {
    background-color: #9b87f5;
}

.btn-create:hover {
    background-color: #7a6ad8;
}

.btn-edit {
    background-color: #ffc107;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>
@endsection