@extends('welcome')

@section('name', 'Modifier une Filière')

@section('content')
<div class="containerer">
    <h1 class="page-title">Modifier la Filière</h1>

    <form action="{{ route('filiere.update', $filiere->filiere_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="filiere_nom">Nom de la Filière :</label>
            <input type="text" name="filiere_nom" id="filiere_nom" class="form-control" value="{{ $filiere->filiere_nom }}" required>
        </div>

        <button type="submit" class="btn-submit">Mettre à jour</button>
    </form>
</div>

<style>
.containerer {
    max-width: 600px;
    margin: 15rem 2rem 2rem 36rem;
    padding: 2rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
}

.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #9b87f5;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-size: 16px;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-submit {
    display: inline-block;
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

.form-group input:focus {
    border-color: #9b87f5;
    outline: none;
}
.btn-next:hover,
    .btn-submit:hover {
        color: #9b87f5;
        background-color: #fff;
        border: 1px solid #9b87f5;
    }
    
</style>
@endsection