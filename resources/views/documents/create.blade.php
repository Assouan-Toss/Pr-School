@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            {{-- Carte du formulaire --}}
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle p-3 me-3" style="background-color: #3D80DB !important;">
                            <i class="fas fa-file-upload text-white fa-lg"></i>
                        </div>
                        <div>
                            <h2 class="mb-1" style="color: #1B13AD;">Ajouter un document</h2>
                            <p class="text-muted mb-0">Partagez un document avec vos élèves ou collègues</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" 
                          action="{{ route('documents.store') }}" 
                          enctype="multipart/form-data"
                          id="documentForm">
                        @csrf

                        {{-- Titre du document --}}
                        <div class="mb-4">
                            <label for="titre" class="form-label fw-bold" style="color: #1B13AD;">
                                <i class="fas fa-heading me-2"></i>Titre du document
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="titre" 
                                   id="titre"
                                   class="form-control form-control-lg @error('titre') is-invalid @enderror"
                                   placeholder="Ex: Cours de mathématiques - Chapitre 3"
                                   value="{{ old('titre') }}"
                                   required
                                   style="border-radius: 10px; border-color: #ddd; padding: 12px 16px;">
                            @error('titre')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Un titre clair et descriptif</div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold" style="color: #1B13AD;">
                                <i class="fas fa-align-left me-2"></i>Description
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Décrivez brièvement le contenu du document..."
                                      rows="4"
                                      style="border-radius: 10px; border-color: #ddd; resize: none;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text d-flex justify-content-between mt-2">
                                <span>Optionnel mais recommandé</span>
                                <span id="charCount">0/500 caractères</span>
                            </div>
                        </div>

                        {{-- Fichier --}}
                        <div class="mb-4">
                            <label for="fichier" class="form-label fw-bold" style="color: #1B13AD;">
                                <i class="fas fa-paperclip me-2"></i>Fichier
                                <span class="text-danger">*</span>
                            </label>
                            <div class="file-upload-area border rounded-3 p-4 text-center @error('fichier') border-danger @enderror"
                                 style="border-style: dashed !important; border-color: #3D80DB; background-color: #f8f9fa; cursor: pointer;"
                                 onclick="document.getElementById('fichier').click()"
                                 id="fileUploadArea">
                                <div class="upload-icon mb-3">
                                    <i class="fas fa-cloud-upload-alt fa-3x" style="color: #3D80DB;"></i>
                                </div>
                                <h5 class="mb-2" style="color: #1B13AD;">Glissez-déposez ou cliquez pour téléverser</h5>
                                <p class="text-muted mb-3">Formats supportés: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, ZIP</p>
                                <input type="file" 
                                       name="file_path" 
                                       id="fichier"
                                       class="form-control d-none"
                                       required
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.zip,.rar"
                                       onchange="updateFileName()">
                                <div id="fileName" class="mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-info-circle me-1"></i>Aucun fichier sélectionné
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-shield-alt me-1"></i>Taille max: 20MB
                                    </span>
                                </div>
                            </div>
                            @error('fichier')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Visibilité --}}
                        <div class="mb-5">
                            <label for="visible_pour" class="form-label fw-bold" style="color: #1B13AD;">
                                <i class="fas fa-eye me-2"></i>Visibilité
                                <span class="text-danger">*</span>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check card border rounded-3 p-3 h-100 @if(old('visible_pour', 'eleves') == 'eleves') border-primary shadow-sm @endif"
                                         onclick="selectVisibility('eleves')"
                                         style="cursor: pointer; border-color: #ddd; transition: all 0.3s;">
                                        <div class="form-check-input d-none">
                                            <input type="radio" name="visible_pour" value="eleves" id="eleves" 
                                                   class="form-check-input" 
                                                   {{ old('visible_pour', 'eleves') == 'eleves' ? 'checked' : '' }} required>
                                        </div>
                                        <div class="text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-user-graduate fa-2x" style="color: #3D80DB;"></i>
                                            </div>
                                            <h6 class="mb-1" style="color: #1B13AD;">Élèves</h6>
                                            <p class="text-muted small mb-0">Visible uniquement par les élèves</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-check card border rounded-3 p-3 h-100 @if(old('visible_pour') == 'professeurs') border-primary shadow-sm @endif"
                                         onclick="selectVisibility('professeurs')"
                                         style="cursor: pointer; border-color: #ddd; transition: all 0.3s;">
                                        <div class="form-check-input d-none">
                                            <input type="radio" name="visible_pour" value="professeurs" id="professeurs" 
                                                   class="form-check-input" 
                                                   {{ old('visible_pour') == 'professeurs' ? 'checked' : '' }} required>
                                        </div>
                                        <div class="text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-chalkboard-teacher fa-2x" style="color: #3D80DB;"></i>
                                            </div>
                                            <h6 class="mb-1" style="color: #1B13AD;">Professeurs</h6>
                                            <p class="text-muted small mb-0">Visible uniquement par les professeurs</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-check card border rounded-3 p-3 h-100 @if(old('visible_pour') == 'tous') border-primary shadow-sm @endif"
                                         onclick="selectVisibility('tous')"
                                         style="cursor: pointer; border-color: #ddd; transition: all 0.3s;">
                                        <div class="form-check-input d-none">
                                            <input type="radio" name="visible_pour" value="tous" id="tous" 
                                                   class="form-check-input" 
                                                   {{ old('visible_pour') == 'tous' ? 'checked' : '' }} required>
                                        </div>
                                        <div class="text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-users fa-2x" style="color: #3D80DB;"></i>
                                            </div>
                                            <h6 class="mb-1" style="color: #1B13AD;">Tous</h6>
                                            <p class="text-muted small mb-0">Visible par tout le monde</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('visible_pour')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ url()->previous() }}" 
                               class="btn btn-lg btn-outline-secondary"
                               style="border-radius: 10px; padding: 10px 24px;">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            
                            <button type="submit" 
                                    class="btn btn-lg text-white"
                                    style="background-color: #3D80DB; border-radius: 10px; padding: 10px 30px;">
                                <i class="fas fa-save me-2"></i>Enregistrer le document
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animation pour l'apparition */
    .card {
        animation: fadeInUp 0.5s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Styles pour les cartes de visibilité */
    .form-check .card:hover {
        border-color: #3D80DB !important;
        transform: translateY(-2px);
    }
    
    .form-check .card.border-primary {
        border-width: 2px !important;
        border-color: #3D80DB !important;
        background-color: rgba(61, 128, 219, 0.05);
    }
    
    /* Zone de téléversement */
    .file-upload-area:hover {
        background-color: #f0f7ff !important;
        border-color: #1B13AD !important;
    }
    
    /* Effets de focus */
    .form-control:focus {
        border-color: #3D80DB !important;
        box-shadow: 0 0 0 0.25rem rgba(61, 128, 219, 0.25);
    }
    
    /* Style pour les messages d'erreur */
    .is-invalid {
        border-color: #e74c3c !important;
    }
    
    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.875rem;
    }
    
    /* Badge de fichier */
    .file-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background-color: #e8f4ff;
        border-radius: 20px;
        color: #1B13AD;
        font-size: 0.875rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Compteur de caractères pour la description
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        
        description.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length + '/500 caractères';
            
            if (length > 500) {
                charCount.style.color = '#e74c3c';
            } else if (length > 450) {
                charCount.style.color = '#f39c12';
            } else {
                charCount.style.color = '#6c757d';
            }
        });
        
        // Initialiser le compteur
        description.dispatchEvent(new Event('input'));
        
        // Drag and drop pour le fichier
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fichier');
        
        // Empêcher le comportement par défaut
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Effet visuel pendant le drag
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            fileUploadArea.style.backgroundColor = '#e8f4ff';
            fileUploadArea.style.borderColor = '#1B13AD';
        }
        
        function unhighlight() {
            fileUploadArea.style.backgroundColor = '#f8f9fa';
            fileUploadArea.style.borderColor = '#3D80DB';
        }
        
        // Gérer le drop
        fileUploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                updateFileName();
            }
        }
        
        // Prévisualisation de la soumission
        document.getElementById('documentForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Afficher un indicateur de chargement
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enregistrement...';
            submitBtn.disabled = true;
            
            // Optionnel: restaurer après 10 secondes si quelque chose échoue
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        });
    });
    
    function updateFileName() {
        const fileInput = document.getElementById('fichier');
        const fileNameDiv = document.getElementById('fileName');
        
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileSize = (file.size / (1024*1024)).toFixed(2); // MB
            
            // Récupérer l'extension
            const extension = file.name.split('.').pop().toUpperCase();
            
            // Icône selon le type
            const icon = getFileIcon(extension);
            
            fileNameDiv.innerHTML = `
                <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded">
                    <div class="d-flex align-items-center">
                        <i class="${icon.class} fa-2x me-3" style="color: ${icon.color};"></i>
                        <div>
                            <h6 class="mb-0" style="color: #1B13AD;">${file.name}</h6>
                            <small class="text-muted">${extension} • ${fileSize} MB</small>
                        </div>
                    </div>
                    <span class="badge text-white" style="background-color: #3D80DB;">
                        <i class="fas fa-check me-1"></i>Prêt
                    </span>
                </div>
            `;
        } else {
            fileNameDiv.innerHTML = `
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>Aucun fichier sélectionné
                </p>
            `;
        }
    }
    
    function getFileIcon(extension) {
        const ext = extension.toLowerCase();
        if (['pdf'].includes(ext)) return {class: 'fas fa-file-pdf', color: '#e74c3c'};
        if (['doc', 'docx'].includes(ext)) return {class: 'fas fa-file-word', color: '#2c5aa0'};
        if (['xls', 'xlsx'].includes(ext)) return {class: 'fas fa-file-excel', color: '#1d6f42'};
        if (['ppt', 'pptx'].includes(ext)) return {class: 'fas fa-file-powerpoint', color: '#d35400'};
        if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) return {class: 'fas fa-file-image', color: '#9b59b6'};
        if (['zip', 'rar'].includes(ext)) return {class: 'fas fa-file-archive', color: '#f39c12'};
        return {class: 'fas fa-file', color: '#3D80DB'};
    }
    
    function selectVisibility(value) {
        // Désélectionner toutes les cartes
        document.querySelectorAll('.form-check .card').forEach(card => {
            card.classList.remove('border-primary', 'shadow-sm');
            card.style.backgroundColor = '';
        });

        // Cacher le champ de téléversement 
        // document.getElementById('fileUploadArea').style.display = 'none';
        
        // Sélectionner la carte cliquée
        const selectedCard = document.getElementById(value).closest('.card');
        selectedCard.classList.add('border-primary', 'shadow-sm');
        selectedCard.style.backgroundColor = 'rgba(61, 128, 219, 0.05)';
        
        // Cocher le radio correspondant
        document.getElementById(value).checked = true;
    }
    
    // Initialiser la visibilité sélectionnée
    document.addEventListener('DOMContentLoaded', function() {
        const selected = document.querySelector('input[name="visible_pour"]:checked');
        if (selected) {
            selectVisibility(selected.value);
        }
    });
</script>
@endsection