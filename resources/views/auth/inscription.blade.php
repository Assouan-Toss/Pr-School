<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Élève</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #444;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 15px;
            transition: color 0.3s;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f8f9fa;
            color: #333;
        }

        .form-input:focus {
            outline: none;
            border-color: #3D80DB;
            background: white;
            box-shadow: 0 0 0 3px rgba(61, 128, 219, 0.1);
        }

        .form-input::placeholder {
            color: #aaa;
        }

        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 15px;
            background: #f8f9fa;
            color: #333;
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
            box-shadow: 0 0 0 3px rgba(61, 128, 219, 0.1);
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 14px;
        }

        .toggle-password:hover {
            color: #3D80DB;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3D80DB 0%, #1B13AD 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(61, 128, 219, 0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message::before {
            content: "⚠";
        }

        .success-message {
            background: #2ecc71;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #3D80DB;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #1B13AD;
            text-decoration: underline;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
                border-radius: 16px;
            }
            
            .form-header h1 {
                font-size: 24px;
            }
            
            .form-input,
            .form-select {
                padding: 12px 14px;
            }
        }

        /* Animation pour les champs invalides */
        .form-input:invalid:not(:focus):not(:placeholder-shown) {
            border-color: #e74c3c;
            animation: shake 0.3s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Inscription Élève</h1>
            <p>Créez votre compte pour accéder à la plateforme</p>
        </div>

        <!-- Afficher les messages d'erreur de validation -->
        @if($errors->any())
            <div class="error-message" style="background: #ffe6e6; color: #e74c3c; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul style="margin-top: 8px; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Afficher les messages de succès -->
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('eleve.register.store') }}">
            @csrf

            <!-- Nom complet -->
            <div class="form-group">
                <label class="form-label required">Nom complet</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="form-input"
                       placeholder="Entrez votre nom complet">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label required">Adresse email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="form-input"
                       placeholder="exemple@email.com">
            </div>

            <!-- Classe -->
            <div class="form-group">
                <label class="form-label required">Classe</label>
                <select name="classe_id"
                        required
                        class="form-select">
                    <option value="">-- Choisir une classe --</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}"
                            {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label class="form-label required">Mot de passe</label>
                <div class="password-container">
                    <input type="password"
                           name="password"
                           required
                           class="form-input"
                           placeholder="Minimum 8 caractères"
                           minlength="8">
                    <button type="button" class="toggle-password" onclick="togglePassword(this)">Afficher</button>
                </div>
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="form-group">
                <label class="form-label required">Confirmation du mot de passe</label>
                <div class="password-container">
                    <input type="password"
                           name="password_confirmation"
                           required
                           class="form-input"
                           placeholder="Répétez votre mot de passe"
                           minlength="8">
                    <button type="button" class="toggle-password" onclick="togglePassword(this)">Afficher</button>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="submit-btn">
                Créer mon compte
            </button>

            <!-- Lien vers la connexion -->
            <div class="login-link">
                Déjà un compte ? <a href="{{ route('connexion') }}">Connectez-vous</a>
            </div>
        </form>
    </div>

    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            button.textContent = type === 'password' ? 'Afficher' : 'Masquer';
        }

        // Validation en temps réel
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('touched');
                }
            });
        });

        // Animation lors de la soumission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            submitBtn.textContent = 'Inscription en cours...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>