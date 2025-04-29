@extends('welcome')

@section('name', 'Détails de l\'Agrément')

@section('content')
<div class="agrement-detail-container">
    <div class="agrement-header">
        <h1 class="agrement-title">
            <i class='bx bx-detail'></i> Détails de l'Agrément
        </h1>
    </div>

    <div class="agrement-card">
        <div class="agrement-content">
            <div class="document-preview">
                @if(file_exists(public_path('agrements/' . $agrement->document)))
                    <div class="document-icon">
                        <i class='bx bxs-file-pdf'></i>
                    </div>
                    <a href="{{ asset('agrements/' . $agrement->document) }}" target="_blank" class="btn-download">
                        <i class='bx bxs-cloud-download'></i> Télécharger le document
                    </a>
                @else
                    <div class="document-missing">
                        <i class='bx bx-error-circle'></i>
                        <p>Le document n'est pas disponible</p>
                    </div>
                @endif
            </div>

            <div class="agrement-info">
                <div class="info-section">
                    <h3><i class='bx bx-building'></i> Informations sur la structure</h3>
                    <div class="info-row">
                        <span class="info-label">Structure :</span>
                        <span class="info-value">{{ $agrement->structure }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Référence :</span>
                        <span class="info-value">{{ $agrement->reference }}</span>
                    </div>
                </div>

                <div class="info-section">
                    <h3><i class='bx bx-calendar'></i> Dates et groupement</h3>
                    <div class="info-row">
                        <span class="info-label">Date de livraison :</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($agrement->date_deliver)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Groupement :</span>
                        <span class="info-value badge">{{ $agrement->groupement_nom ?? 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('agrement.index') }}" class="btn btn-back">
                <i class='bx bx-arrow-back'></i> Retour à la liste
            </a>
            <div class="action-group">
                <a href="{{ route('agrement.edit', $agrement->agrement_id) }}" class="btn btn-edit">
                    <i class='bx bx-edit-alt'></i> Modifier
                </a>
                <form action="{{ route('agrement.destroy', $agrement->agrement_id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agrément ?')">
                        <i class='bx bx-trash'></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
:root {
    --primary-color: #7367F0;
    --primary-hover: #5D50E6;
    --secondary-color: #82868B;
    --success-color: #28C76F;
    --danger-color: #EA5455;
    --warning-color: #FF9F43;
    --info-color: #00CFE8;
    --light-color: #F8F8F8;
    --dark-color: #4B4B4B;
    --border-color: #EBE9F1;
    --card-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    --transition: all 0.3s ease;
}

.agrement-detail-container {
    max-width: 1200px;
    margin: 6rem 1rem 1rem 19rem;
    padding: 0 1rem;
    font-family: 'Montserrat', 'Poppins', sans-serif;
}

.agrement-header {
    margin-bottom: 2rem;
}

.agrement-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.agrement-title i {
    color: var(--primary-color);
    font-size: 2rem;
}

.agrement-card {
    background: white;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    padding: 2rem;
    overflow: hidden;
}

.agrement-content {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
}

.document-preview {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background-color: rgba(115, 103, 240, 0.05);
    border-radius: 8px;
    border: 1px dashed var(--border-color);
}

.document-icon {
    font-size: 5rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.btn-download {
    background-color: var(--primary-color);
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 6px;
    font-size: 0.95rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(115, 103, 240, 0.3);
}

.btn-download:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(115, 103, 240, 0.4);
}

.document-missing {
    text-align: center;
    color: var(--secondary-color);
}

.document-missing i {
    font-size: 3rem;
    color: var(--danger-color);
    margin-bottom: 1rem;
    display: block;
}

.document-missing p {
    margin: 0;
    font-size: 1rem;
}

.agrement-info {
    flex: 1;
}

.info-section {
    margin-bottom: 1.5rem;
}

.info-section h3 {
    font-size: 1.1rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-row {
    display: flex;
    margin-bottom: 0.8rem;
    padding-bottom: 0.8rem;
    border-bottom: 1px solid var(--border-color);
}

.info-label {
    font-weight: 600;
    color: var(--dark-color);
    width: 160px;
}

.info-value {
    color: var(--dark-color);
    flex: 1;
}

.badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    background-color: rgba(40, 199, 111, 0.12);
    color: var(--success-color);
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid var(--border-color);
    padding-top: 1.5rem;
}

.action-group {
    display: flex;
    gap: 1rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    border: none;
}

.btn-back {
    background-color: var(--secondary-color);
    color: white;
}

.btn-back:hover {
    background-color: #6c757d;
    transform: translateY(-2px);
}

.btn-edit {
    background-color: var(--warning-color);
    color: white;
}

.btn-edit:hover {
    background-color: #e6953a;
    transform: translateY(-2px);
}

.btn-delete {
    background-color: var(--danger-color);
    color: white;
}

.btn-delete:hover {
    background-color: #d94546;
    transform: translateY(-2px);
}

.delete-form {
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .agrement-content {
        flex-direction: column;
    }
    
    .document-preview {
        margin-bottom: 2rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .action-group {
        width: 100%;
        justify-content: flex-end;
    }
}
</style>

<!-- Include Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection