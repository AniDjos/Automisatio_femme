
@extends('welcome')

@section('name', 'Rapport sur un Membre')

@section('content')
<div class="container-rapport">
    <h1 class="rapport-title">Rapport sur le Membre</h1>

    <div class="rapport-details">
        <div class="detail-item">
            <strong>Nom :</strong> <span>{{ $membre->nom }}</span>
        </div>
        <div class="detail-item">
            <strong>Prénom :</strong> <span>{{ $membre->prenom }}</span>
        </div>
        <div class="detail-item">
            <strong>Rôle :</strong> <span>{{ $membre->role }}</span>
        </div>
        <div class="detail-item">
            <strong>Âge :</strong> <span>{{ $membre->age }} ans</span>
        </div>
        <div class="detail-item">
            <strong>Téléphone :</strong> <span>{{ $membre->telephone }}</span>
        </div>
        <div class="detail-item">
            <strong>Email :</strong> <span>{{ $membre->email }}</span>
        </div>
        <div class="detail-item">
            <strong>Groupement :</strong> <span>{{ $membre->groupement_nom ?? 'Non spécifié' }}</span>
        </div>
    </div>

    <div class="rapport-actions">
        <a href="{{ route('membres.edit', $membre->id) }}" class="btn-action btn-edit">
            <i class="fas fa-edit"></i> Modifier
        </a>
        <form action="{{ route('membres.destroy', $membre->id) }}" method="POST" class="form-delete" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn-action btn-delete" onclick="confirmDelete({{ $membre->id }})">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>

<script>
    function confirmDelete(membreId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${membreId}`).submit();
            }
        });
    }
</script>
@endsection