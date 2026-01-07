<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des classes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 2px solid #e0e7ff;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #1B13AD 0%, #3D80DB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Carte de formulaire */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e7ff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #1B13AD;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title::before {
            content: "📚";
            font-size: 24px;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f9fafb;
            color: #111827;
        }

        .form-input:focus {
            outline: none;
            border-color: #3D80DB;
            background: white;
            box-shadow: 0 0 0 4px rgba(61, 128, 219, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Sélecteur */
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            background: #f9fafb;
            color: #111827;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            transition: all 0.3s;
        }

        .form-select:focus {
            outline: none;
            border-color: #3D80DB;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(61, 128, 219, 0.1);
        }

        /* Bouton */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3D80DB 0%, #1B13AD 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(61, 128, 219, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary::after {
            content: "➕";
            font-size: 18px;
        }

        /* Carte de liste */
        .list-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e7ff;
        }

        .list-header {
            background: linear-gradient(135deg, #3D80DB 0%, #1B13AD 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .class-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Table */
        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #3D80DB 0%, #1B13AD 100%);
            color: white;
        }

        .table th {
            padding: 18px 24px;
            text-align: left;
            font-weight: 600;
            font-size: 15px;
        }

        .table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s;
        }

        .table tbody tr:hover {
            background: #f0f7ff;
        }

        .table td {
            padding: 18px 24px;
            color: #374151;
            font-size: 15px;
        }

        /* Badge de niveau */
        .level-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 10px;
        }

        .level-maternelle { background: #fef3c7; color: #92400e; }
        .level-primaire { background: #d1fae5; color: #065f46; }
        .level-college { background: #dbeafe; color: #1e40af; }
        .level-lycee { background: #ede9fe; color: #5b21b6; }
        .level-superieur { background: #fce7f3; color: #9d174d; }

        /* État vide */
        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #9ca3af;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease;
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

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Badge de classe */
        .class-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            color: #1B13AD;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
            gap: 8px;
        }

        .class-badge::before {
            content: "🏫";
        }

        /* Actions */
        .actions-cell {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-edit {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-edit:hover {
            background: #bfdbfe;
        }

        .action-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-delete:hover {
            background: #fecaca;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title {
                font-size: 28px;
            }

            .form-card,
            .list-card {
                padding: 20px;
            }

            .table th,
            .table td {
                padding: 14px 16px;
            }

            .btn {
                padding: 12px 24px;
                width: 100%;
            }
        }

        /* Animation des nouvelles classes */
        @keyframes highlight {
            0% { background-color: #e0f2fe; }
    100% { background-color: transparent; }
        }

        .new-class {
            animation: highlight 2s ease;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="header">
            <h1 class="page-title"> Gestion des classes</h1>
        </div>

        <!-- Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <span>⚠️</span>
                <div>
                    <strong>Veuillez corriger les erreurs :</strong>
                    <ul style="margin-top: 8px; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="dashboard-grid">
            <!-- Formulaire de création -->
            <div class="form-card">
                <div class="card-title">Créer une nouvelle classe</div>

                <form method="POST" action="/admin/classes/create">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nom de la classe</label>
                        <input type="text" 
                               name="nom" 
                               class="form-input" 
                               placeholder="Ex: Terminale S, 3ème B..."
                               required
                               maxlength="50">
                    </div>

                    <!-- NOUVEAU CHAMP : Niveau -->
                    <div class="form-group">
                        <label class="form-label">Niveau</label>
                        <select name="niveau" class="form-select" required>
                            <option value="">-- Sélectionner un niveau --</option>
                            <option value="Maternelle" {{ old('niveau') == 'Maternelle' ? 'selected' : '' }}>Maternelle</option>
                            <option value="Primaire" {{ old('niveau') == 'Primaire' ? 'selected' : '' }}>Primaire</option>
                            <option value="Collège" {{ old('niveau') == 'Collège' ? 'selected' : '' }}>Collège</option>
                            <option value="Lycée" {{ old('niveau') == 'Lycée' ? 'selected' : '' }}>Lycée</option>
                            <option value="Supérieur" {{ old('niveau') == 'Supérieur' ? 'selected' : '' }}>Supérieur</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Créer la classe
                    </button>
                </form>
            </div>

            <!-- Liste des classes -->
            <div class="list-card">
                <div class="list-header">
                    <h2>Classes existantes</h2>
                    <div class="class-count">
                        {{ $classes->count() }} classe(s)
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Classe</th>
                                <th>Niveau</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Pour la gestion de l'animation des nouvelles classes
                                $latestClassId = session('latest_class_id');
                            @endphp
                            
                            @forelse($classes as $classe)
                                <tr class="{{ $latestClassId == $classe->id ? 'new-class' : '' }}">
                                    <td>
                                        <span class="class-badge">{{ $classe->nom }}</span>
                                    </td>
                                    <td>
                                        <span class="level-badge level-{{ strtolower($classe->niveau ?? 'non-défini') }}">
                                            {{ $classe->niveau ?? 'Non défini' }}
                                        </span>
                                    </td>
                                    <td class="actions-cell">
                                        <button class="action-btn action-edit" 
                                                onclick="editClass({{ $classe->id }}, '{{ $classe->nom }}', '{{ $classe->niveau }}')">
                                            Modifier
                                        </button>
                                        <form method="POST" action="/admin/classes/{{ $classe->id }}/delete" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Supprimer cette classe ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn action-delete">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">🏫</div>
                                            <p>Aucune classe n'a été créée pour le moment</p>
                                            <p class="text-sm mt-2">Commencez par créer votre première classe</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'édition (caché par défaut) -->
    <div id="editModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 20px; max-width: 500px; width: 90%;">
            <h2 style="font-size: 20px; font-weight: 600; color: #1B13AD; margin-bottom: 20px;">Modifier la classe</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Nom de la classe</label>
                    <input type="text" id="editClassName" name="nom" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Niveau</label>
                    <select name="niveau" id="editClassNiveau" class="form-select" required>
                        <option value="">-- Sélectionner un niveau --</option>
                        <option value="Maternelle">Maternelle</option>
                        <option value="Primaire">Primaire</option>
                        <option value="Collège">Collège</option>
                        <option value="Lycée">Lycée</option>
                        <option value="Supérieur">Supérieur</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" onclick="closeEditModal()" class="btn" style="background: #e5e7eb; color: #374151;">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fonction pour éditer une classe
        function editClass(id, name, niveau) {
            document.getElementById('editClassName').value = name;
            document.getElementById('editClassNiveau').value = niveau || '';
            document.getElementById('editForm').action = `/admin/classes/${id}/update`;
            document.getElementById('editModal').style.display = 'flex';
        }

        // Fermer le modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Animation de suppression
        document.querySelectorAll('.action-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cette classe ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });

        // Focus sur le champ de formulaire
        document.querySelector('input[name="nom"]').focus();

        // Validation du formulaire
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Création en cours...';
            submitBtn.disabled = true;
        });

        // Auto-format du nom de classe
        const classNameInput = document.querySelector('input[name="nom"]');
        classNameInput.addEventListener('input', function() {
            // Met la première lettre en majuscule
            if (this.value.length === 1) {
                this.value = this.value.toUpperCase();
            }
        });

        // Fonction pour déterminer la classe CSS du badge de niveau
        function getLevelBadgeClass(niveau) {
            const niveauLower = niveau.toLowerCase();
            if (niveauLower.includes('maternelle')) return 'level-maternelle';
            if (niveauLower.includes('primaire')) return 'level-primaire';
            if (niveauLower.includes('collège') || niveauLower.includes('college')) return 'level-college';
            if (niveauLower.includes('lycée') || niveauLower.includes('lycee')) return 'level-lycee';
            if (niveauLower.includes('supérieur') || niveauLower.includes('superieur')) return 'level-superieur';
            return '';
        }
    </script>
</body>
</html>